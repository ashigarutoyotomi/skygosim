<?php


namespace App\Http\Controllers\Pages;


use App\Actions\User\UserAction;
use App\Actions\User\UserAddressAction;
use App\Domains\Order\Model\Order;
use App\Domains\User\Models\UserCart;
use App\DTO\User\CreateUserAddressData;
use App\DTO\User\CreateUserData;
use App\Gateways\User\UserGateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\InternetPackage\PurchaseInternetPackageRequest;
use App\Models\InternetPackage;
use App\Models\Sim\Sim;
use App\Models\User;
use App\Models\User\UserInternetPackage;
use Illuminate\Support\Facades\Auth;

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

        try {
            $payment = $user->charge(
                $request->input('amount') * 100,
                $request->input('payment_method_id'),
            );

            $payment = $payment->asStripePaymentIntent();

            $endpoint = "https://simapi.udbac.com/sim/v1/api/payorder";
            $client = new \GuzzleHttp\Client();

            foreach ($carts as $cart) {
                $package = InternetPackage::find($cart->item_id);
                $sim = Sim::find($cart->sim_id);

                if ($user && $package && $sim) {
                    $response = $client->request('POST', $endpoint, ['query' => [
                        'iccid' => $sim->iccid,
                        'packageId' => $package->package_id,
                        'currency' => 'USD',
                        'ourOrderID' => 'skygosimorderid' . $request->input('package_id'),
                    ]]);

                    $statusCode = $response->getStatusCode();
                    $content = $response->getBody();

                    $userInternetPackage = UserInternetPackage::create([
                        'user_id' => $user->id,
                        'sim_id' => $sim->id,
                        'internet_package_id' => $package->id,
                        'bought_price' => $request->input('amount'),
                    ]);
                }
            }

            $order->status = Order::ORDER_STATUS_DONE;

            return [
                'payment' => $payment,
            ];
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
