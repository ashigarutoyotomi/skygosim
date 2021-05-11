<?php


namespace App\Http\Controllers\InternetPackage;


use App\Domains\InternetPackages\Gateways\InternetPackageGateway;
use App\Domains\InternetPackages\Imports\InternetPackagesImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\InternetPackage\UploadInternetPackagesFileRequest;
use Maatwebsite\Excel\Facades\Excel;

class InternetPackageController extends Controller
{
    public function index()
    {
        $internetPackagesGateway = new InternetPackageGateway;

        return $internetPackagesGateway
            ->toggleGTTPrice(true)
            ->getPaginatedInternetPackages();
    }

    public function uploadPackages(UploadInternetPackagesFileRequest $request)
    {
        Excel::import(new InternetPackagesImport, $request->file);

        return true;
    }
}
