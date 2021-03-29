<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;
use App\Models\InternetPackage;

class HomePageController extends Controller
{
    public function index()
    {
        $internetPackages = InternetPackage::orderBy('area_eng')->get();

        return view('home', [
            'internetPackages' => $internetPackages->groupBy('area_eng'),
        ]);
    }
}
