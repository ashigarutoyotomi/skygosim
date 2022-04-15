<?php


namespace App\Http\Controllers\Pages;


use App\Actions\User\UserAction;
use App\Actions\User\UserAddressAction;
use App\Domains\InternetPackages\Gateways\InternetPackageGateway;
use App\Domains\InternetPackages\Models\InternetPackage;
use App\Domains\User\Actions\UserCartAction;
use App\Domains\User\DTO\UserCartDTO\CreateUserCartData;
use App\Domains\User\Models\UserCart;
use App\DTO\User\CreateUserAddressData;
use App\DTO\User\CreateUserData;
use App\Gateways\User\UserGateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\InternetPackage\PurchaseInternetPackageRequest;
use App\Http\Requests\Users\AddToCartInternetPackageRequest;
use App\Models\Sim\Sim;
use App\Models\User;
use App\Models\User\UserInternetPackage;
use Illuminate\Support\Facades\Auth;

class PackagesPageController extends Controller
{
    public function index()
    {
        return view('internet-packages.internet');
    }

    public function getAllPackages()
    {
        $internetPackagesGateway = new InternetPackageGateway;

        return $internetPackagesGateway->getAllInternetPackages();
    }

    public function checkout(PurchaseInternetPackageRequest $request)
    {
        $user = User::where('email', $request->get('email_address'))->first();
        $sim = Sim::where('iccid', $request->get('iccid'))->first();
        $internetPackage = InternetPackage::where('package_id', $request->get('package_id'))
            ->first();

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

            $response = $client->request('POST', $endpoint, ['query' => [
                'iccid' => $request->get('iccid'),
                'packageId' => $request->input('package_id'),
                'currency' => 'USD',
                'ourOrderID' => 'skygosimorderid' . $request->input('package_id'),
            ]]);

            $statusCode = $response->getStatusCode();
            $content = $response->getBody();

            if ($user && $sim && $internetPackage) {
                $userInternetPackage = UserInternetPackage::create([
                    'user_id' => $user->id,
                    'sim_id' => $sim->id,
                    'internet_package_id' => $internetPackage->id,
                    'bought_price' => $request->input('amount'),
                ]);
            }

            return [
                'payment' => $payment,
                'statusCode' => $statusCode,
                'content' => $content,
                'response' => $response
            ];
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function addToCart(AddToCartInternetPackageRequest $request)
    {
        $userCartData = new CreateUserCartData([
            'user_id' => (int)$request->user_id,
            'item_type' => UserCart::ITEM_TYPE_INTERNET_PACKAGE_FROM_FILE,
            'item_id' => $request->internet_package_id,
            'sim_id' => (int)$request->sim_id,
            'quantity' => 1,
            'currency' => UserCart::CURRENCY_USD,
            'price' => (float)$request->price,
            'status' => UserCart::CART_STATUS_NEW,
        ]);

        return (new UserCartAction)->create($userCartData);
    }
}
