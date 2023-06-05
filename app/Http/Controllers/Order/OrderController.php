<?php


namespace App\Http\Controllers\Order;


use App\Domains\Order\Model\Order;
use App\Domains\User\Models\UserCart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        $carts = UserCart::whereIn('id', $request->item_ids)->get();
        $totalPrice = 0;

        foreach ($carts as $cart) {
            $cart->status = UserCart::CART_STATUS_ORDER;
            $cart->save();

            $totalPrice += $cart->price;
        }

        return Order::create([
            'user_id' => $user->id,
            'order_key' => time() . mt_rand() . $user->id,
            'cart_items' => $request->item_ids,
            'price' => $totalPrice,
            'status' => Order::ORDER_STATUS_NEW,
        ]);
    }
}
