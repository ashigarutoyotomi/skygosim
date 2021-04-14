<?php


namespace App\Http\Controllers\Purchases;


use App\Http\Controllers\Controller;
use App\Models\User\UserInternetPackage;

class PurchasesInternetPackagesController extends Controller
{
    public function index()
    {
        $packages = UserInternetPackage::with([
            'user',
            'sim.dealer',
            'internet_package'
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return $packages;
    }

    public function show($id)
    {
        return UserInternetPackage::with([
            'user',
            'sim.dealer',
            'internet_package'
        ])
            ->find($id);
    }
}
