<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;

class MobileAppsPageController extends Controller
{
    public function index()
    {
        return view('mobile-apps.index');
    }
}
