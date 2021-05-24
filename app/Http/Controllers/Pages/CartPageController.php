<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;

class CartPageController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }
}
