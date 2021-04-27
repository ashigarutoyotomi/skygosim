<?php


namespace App\Http\Controllers\PagesController;


use App\Http\Controllers\Controller;
use App\Models\Pages\Apn;
use App\Models\Region\Region;

class ApnPageController extends Controller
{
    public function index()
    {
        $regions = Region::with('countries.apns.country')->orderBy('name')->get();

        return view('apn.apn', [
            'regions' => $regions,
        ]);
    }
}
