<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;
use App\Models\InternetPackage;

class PackagesPageController extends Controller
{
    public function index()
    {
        $internetPackages = InternetPackage::orderBy('area_eng')->get();

        return view('internet', [
            'internetPackages' => $internetPackages->groupBy('area_eng'),
        ]);
    }
}
