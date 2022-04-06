<?php


namespace App\Http\Controllers\User;


use App\Domains\InternetPackages\Models\InternetPackageFromFile;
use App\Domains\User\Models\UserCart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserCartController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $carts = UserCart::with([
            'sim'
        ])->where('status', UserCart::CART_STATUS_NEW)
            ->where('user_id', $user->id)
            ->get();

        foreach ($carts as $key => $cart) {
            if ($cart->item_type === UserCart::ITEM_TYPE_INTERNET_PACKAGE_FROM_FILE) {
                $carts[$key]['package'] = InternetPackageFromFile::where('package_id', $cart->item_id)->first();
            }
        }

        return $carts;
    }

    public function userCartCounts()
    {
        $user = Auth::user();

        return UserCart::where('status', UserCart::CART_STATUS_NEW)
            ->where('user_id', $user->id)->count();
    }

    public function delete($user_cart_id)
    {
        $userCart = UserCart::find($user_cart_id);

        if ($userCart) {
            $userCart->delete();
        }

        return $userCart;
    }
}
