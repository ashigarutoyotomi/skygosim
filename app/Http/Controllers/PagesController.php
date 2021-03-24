<?php


namespace App\Http\Controllers;


use App\Models\InternetPackage;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function home()
    {
        $internetPackages = InternetPackage::orderBy('area_eng')->get();

        return view('home', [
            'internetPackages' => $internetPackages->groupBy('area_eng'),
        ]);
    }

    public function internet()
    {
        $internetPackages = InternetPackage::orderBy('area_eng')->get();

        return view('internet', [
            'internetPackages' => $internetPackages->groupBy('area_eng'),
        ]);
    }

    public function checkout()
    {
        $user = Auth::user();

        return view('checkouts.checkout', [
            'type' => 'buyInternetPackage',
            'user' => $user,
        ]);
    }

    public function checkoutPhysicalSim()
    {
        $user = Auth::user();

        return view('checkouts.checkout', [
            'type' => 'buyPhysicalSim',
            'user' => $user,
        ]);
    }

    public function checkoutESim()
    {
        $user = Auth::user();

        return view('checkouts.checkout', [
            'type' => 'buyESim',
            'user' => $user,
        ]);
    }

    public function checkoutResult()
    {
        return view('checkouts.result');
    }

    public function addSim()
    {
        return view('add-sim');
    }
}
