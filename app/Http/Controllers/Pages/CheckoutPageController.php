<?php


namespace App\Http\Controllers\Pages;


use App\Actions\User\UserAction;
use App\Actions\User\UserAddressAction;
use App\Domains\InternetPackages\Models\InternetPackageFromFile;
use App\Domains\Order\Model\Order;
use App\Domains\User\Models\UserCart;
use App\Domains\User\Models\UserInternetPackage;
use App\DTO\User\CreateUserAddressData;
use App\DTO\User\CreateUserData;
use App\Gateways\User\UserGateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\InternetPackage\PurchaseInternetPackageRequest;
use App\Models\Sim\Sim;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Psr7\Message;

class CheckoutPageController extends Controller
{
    public function checkoutOrder($order_id)
    {
        $user = Auth::user();
        $order = Order::find($order_id);

        if ($order->user_id === $user->id) {
            return view('checkouts.checkout', [
                'order' => $order,
            ]);
        } else {
            return redirect('/');
        }
    }

    public function physicalSim()
    {
        $user = Auth::user();

        return view('checkouts.physical-sim', [
            'user' => $user,
        ]);
    }

    public function purchase(PurchaseInternetPackageRequest $request)
    {
        $user = User::where('email', $request->get('email_address'))->first();
        $order = Order::find($request->order_id);
        $carts = UserCart::whereIn('id', $order->cart_items)->get();

        if (!$user) {
            $userData = new CreateUserData([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email_address'),
                'password' => (new UserGateway)->getRandomPassword(),
                'role' => User::USER_ROLE_USER,
                'send_to_email' => true,
            ]);

            $user = (new UserAction)->create($userData);
        }

        if ($user && !$user->address) {
            $userAddressData = new CreateUserAddressData([
                'user_id' => $user->id,
                'street' => $request->get('street_address'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'zip_code' => $request->get('zip_code'),
            ]);

            (new UserAddressAction)->create($userAddressData);
        }

        $boughtPrice = $request->input('amount') * 100;
        $payment = $user->charge(
            $boughtPrice,
            $request->input('payment_method_id'),
        );

        $payment = $payment->asStripePaymentIntent();

        $client = new \GuzzleHttp\Client();
        $endpoint = config('services.sim_api.get_access_token');
        $response = $client->request('GET', $endpoint);
        $body = $response->getBody();

        $content = json_decode($body->getContents(), true);
        $endpoint = config('services.sim_api.payorder');

        foreach ($carts as $cart) {
            $sim = Sim::find($cart->sim_id);

            if ($user && $sim) {
                $unique_id = time() . mt_rand() . $user->id;
                $requestBody = [
                    'appKey' => config('services.sim_api.key'),
                    'accessToken' => $content['accessToken'],
                    'iccid' => $sim->iccid,
                    'packageId' => $cart->item_id,
                    'currency' => 'USD',
                    'ourOrderId' => $unique_id,
                ];

                try {
                    $response = $client->request('POST', $endpoint, ['form_params' => $requestBody]);

                    $body = $response->getBody();
                    $content = json_decode($body->getContents(), true);

                    $internetPackage = InternetPackageFromFile::where('package_id', $cart->item_id)->first();

                    UserInternetPackage::create([
                        'user_id' => $user->id,
                        'sim_id' => $sim->id,
                        'internet_package_id' => $internetPackage->id,
                        'bought_price' => $request->input('amount'),
                        'internet_package_from_type' => UserInternetPackage::INTERNET_PACKAGE_FROM_TYPE_FILE,
                        'activated_from_type' => UserInternetPackage::ACTIVATED_FROM_TYPE_WEB,
                    ]);

                    $cart->status = UserCart::CART_STATUS_FINISHED;
                    $cart->save();
                } catch (ClientException $e) {
                    info(Message::toString($e->getRequest()));
                    info(Message::toString($e->getResponse()));
                }
            }
        }

        $order->status = Order::ORDER_STATUS_DONE;
        $order->save();

        return [
            'payment' => $payment,
        ];
    }
}
