<?php


namespace App\Http\Controllers\Pages;


use App\Actions\User\UserAction;
use App\Actions\User\UserAddressAction;
use App\DTO\User\CreateUserAddressData;
use App\DTO\User\CreateUserData;
use App\Gateways\User\UserGateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\InternetPackage\PurchaseInternetPackageRequest;
use App\Models\InternetPackage;
use App\Models\Sim\Sim;
use App\Models\User;
use App\Models\User\UserInternetPackage;

class PackagesPageController extends Controller
{
    public function index()
    {
        $internetPackages = InternetPackage::orderBy('area_eng')->get();

        return view('internet', [
            'internetPackages' => $internetPackages->groupBy('area_eng'),
        ]);
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

        if (!$user->address) {
            $userAddressData = new CreateUserAddressData([
                'user_id' => $user->id,
                'street' => $request->get('street_address'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'zip_code' => $request->get('zip_code'),
            ]);

            (new UserAddressAction)->create($userAddressData);
        }

//        try {
        $payment = $user->charge(
            $request->input('amount') * 100,
            $request->input('payment_method_id'),
        );

        $payment = $payment->asStripePaymentIntent();
//            dd($payment);

//            $endpoint = "http://112.74.196.154:18091/sim/v1/payOrder/test";
//            $client = new \GuzzleHttp\Client();
//
//            $response = $client->request('POST', $endpoint, ['query' => [
//                'iccid' => '89852340003821789113',
//                'packageId' => $request->input('package_id'),
//                'currency' => 'USD',
//                'ourOrderID' => 'orderID89852340003821789113'
//            ]]);
//
//            $statusCode = $response->getStatusCode();
//            $content = $response->getBody();
//
//            dump($statusCode);
//            dd($content);

        $userInternetPackage = UserInternetPackage::create([
            'user_id' => $user->id,
            'sim_id' => $sim->id,
            'internet_package_id' => $internetPackage->id,
            'bought_price' => $request->input('amount'),
        ]);

        return $payment;
//        } catch (\Exception $e) {
//            return response()->json(['message' => $e->getMessage()], 500);
//        }
    }
}
