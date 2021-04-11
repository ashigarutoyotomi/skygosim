<?php


namespace App\Http\Controllers;


use App\Gateways\SettingsGateway;
use App\Http\Requests\InternetPackage\PurchaseInternetPackageRequest;
use App\Http\Requests\InternetPackage\UploadInternetPackagesFileRequest;
use App\Imports\InternetPackagesImport;
use App\Models\InternetPackage;
use App\Models\Sim\Sim;
use App\Models\User;
use App\Models\User\UserInternetPackage;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InternetPackageController extends Controller
{
    public function index()
    {
        $internetPackages = InternetPackage::whereNull('expired_at')
            ->orderBy('area_eng')
            ->paginate(20);

//        $internetPackagesPricePercent = (int)(new SettingsGateway)->getInternetPackagesPricePercentage();
//
//        foreach ($internetPackages as $internetPackage) {
//            $internetPackage->gtt_price_usd = (int)$internetPackage->price_usd
//                + (((int)$internetPackage->price_usd * $internetPackagesPricePercent) / 100);
//        }

        return $internetPackages;
    }

    public function uploadPackages(UploadInternetPackagesFileRequest $request)
    {
        Excel::import(new InternetPackagesImport, $request->file);

        return InternetPackage::orderBy('area_eng')->get();
    }

    public function purchase(PurchaseInternetPackageRequest $request)
    {
        $user = User::where('email', $request->input('email_address'))->first();
        $sim = Sim::where('iccid', $request->get('iccid'))->first();
        $internetPackage = InternetPackage::find($request->get('package_id'));

//        try {
            $payment = $user->charge(
                $request->input('amount') * 100,
                $request->input('payment_method_id'),
            );

            $payment = $payment->asStripePaymentIntent();

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

            $userInternetPackage = UserInternetPackage::create([
                'user_id' => $user->id,
                'sim_id' => $sim->id,
                'internet_package_id' => $internetPackage->id,
                'bought_price' => $request->input('amount'),
            ]);

            dd($userInternetPackage);

            return $payment;
//        } catch (\Exception $e) {
//            return response()->json(['message' => $e->getMessage()], 500);
//        }
    }

}
