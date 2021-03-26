<?php


namespace App\Http\Controllers;


use App\Imports\InternetPackagesImport;
use App\Models\InternetPackage;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InternetPackageController extends Controller
{
    public function index()
    {
        return InternetPackage::orderBy('area_eng')->get();
    }

    public function uploadPackages(Request $request)
    {
        // xls xlsx xlsm xlsb xltx xltm
        $data = $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ], [
            'file.required' => 'Choose a file',
            'file.file' => 'It is must be a file',
            'file.mimes' => 'It is must be a Excel file'
        ]);

        Excel::import(new InternetPackagesImport, $data['file']);

        return InternetPackage::orderBy('area_eng')->get();
    }

    public function purchase(Request $request)
    {
//        $data = $request->validate([
//
//        ]);
        $user = User::where('email', $request->input('email_address'))->first();

        try {
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

            return $payment;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}
