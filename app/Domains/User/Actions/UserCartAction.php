<?php


namespace App\Domains\User\Actions;


use App\Domains\User\DTO\UserCartDTO\CreateUserCartData;
use App\Domains\User\Models\UserCart;

class UserCartAction
{
    public function create(CreateUserCartData $data)
    {
        return UserCart::create([
            'user_id' => $data->user_id,
            'item_type' => $data->item_type,
            'item_id' => $data->item_id,
            'sim_id' => $data->sim_id,
            'quantity' => $data->quantity,
            'currency' => $data->currency,
            'price' => $data->price,
            'status' => $data->status,
        ]);
    }
}
