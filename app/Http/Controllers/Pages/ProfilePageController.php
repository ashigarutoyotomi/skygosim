<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfilePageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $user->load([
            'address',
            'sims.sim',
            'internet_packages.internet_package',
            'internet_packages.sim',
            'orders.sim',
        ]);

        return view('profile.profile', [
            'user' => $user,
        ]);
    }
}
