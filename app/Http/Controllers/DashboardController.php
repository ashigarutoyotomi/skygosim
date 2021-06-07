<?php


namespace App\Http\Controllers;


use App\Domains\InternetPackages\Models\InternetPackage;
use App\Domains\User\Models\UserCart;
use App\Models\Sim\SimOrder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function loadData()
    {
        $user = Auth::user();

        $data = [
            'customersCount' => 0,
            'simOrderCount' => 0,
            'packageOrderCount' => 0,
            'dealersCount' => 0,
        ];

        if ($user->role === User::USER_ROLE_ADMIN) {
            $data = [
                'customersCount' => User::where('role', User::USER_ROLE_USER)->count(),
                'simOrderCount' => SimOrder::count(),
                'dealersCount' => User::where('role', User::USER_ROLE_DEALER)->count(),
                'packageOrderCount' => UserCart::where('item_type', UserCart::ITEM_TYPE_INTERNET_PACKAGE)
                    ->whereIn('status', [UserCart::CART_STATUS_ORDER, UserCart::CART_STATUS_FINISHED])
                    ->count(),
            ];
        }

        return $data;
    }

    public function internetPackagesCardLoadData()
    {
        $inventoryCount = InternetPackage::whereNull('expired_at')->count();
        $purchased = UserCart::where([
            'item_type' => UserCart::ITEM_TYPE_INTERNET_PACKAGE,
            'status' => UserCart::CART_STATUS_FINISHED,
        ])->get();

        $totalPurchasedPrice = 0;

        foreach ($purchased as $item) {
            $totalPurchasedPrice += $item->price;
        }

        return [
            'inventoryCount' => $inventoryCount,
            'purchased' => $purchased->count(),
            'totalPurchasedPrice' => $totalPurchasedPrice,
        ];
    }
}
