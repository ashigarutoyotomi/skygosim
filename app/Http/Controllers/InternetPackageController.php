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

            return $payment;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}
