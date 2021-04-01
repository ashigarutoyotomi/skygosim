<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutPageController extends Controller
{
    public function physicalSim()
    {
        $user = Auth::user();

        return view('checkouts.physical-sim', [
            'user' => $user,
        ]);
    }
}
