<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
