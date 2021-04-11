<?php


namespace App\Http\Controllers\Settings;


use App\Http\Controllers\Controller;
use App\Models\Settings;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::get()
            ->groupBy('section');

        return $settings;
    }
}
