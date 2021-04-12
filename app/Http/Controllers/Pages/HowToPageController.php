<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;

class HowToPageController extends Controller
{
    public function index()
    {
        return view('how-to.how-to');
    }

    public function howToAddESim()
    {
        return view('how-to.how-to-add-e-sim');
    }
}
