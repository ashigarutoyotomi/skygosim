<?php


namespace App\Http\Controllers\InternetPackage;


use App\Http\Controllers\Controller;
use App\Http\Requests\InternetPackage\UploadInternetPackagesFileRequest;
use App\Imports\InternetPackagesImport;
use App\Models\InternetPackage\InternetPackage;
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

        return true;
    }
}
