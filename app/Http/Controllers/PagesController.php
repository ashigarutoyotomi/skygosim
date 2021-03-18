<?php


namespace App\Http\Controllers;


use App\Models\InternetPackage;

class PagesController extends Controller
{
    public function home()
    {
        $internetPackages = InternetPackage::orderBy('area_eng')->get();

        return view('home', [
            'internetPackages' => $internetPackages->groupBy('area_eng'),
        ]);
    }

    public function internet()
    {
        $internetPackages = InternetPackage::orderBy('area_eng')->get();

        return view('internet', [
            'internetPackages' => $internetPackages->groupBy('area_eng'),
        ]);
    }

    public function checkout()
    {
        return view('checkouts.checkout');
    }

    public function checkoutResult()
    {
        return view('checkouts.result');
    }
}
