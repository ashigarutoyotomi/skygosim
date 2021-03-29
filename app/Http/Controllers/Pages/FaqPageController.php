<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;

class FaqPageController extends Controller
{
    public function index()
    {
        return view('faq');
    }
}
