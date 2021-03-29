<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;

class AddSimPageController extends Controller
{
    public function index()
    {
        return view('add-sim');
    }
}
