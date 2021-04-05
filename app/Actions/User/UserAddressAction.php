<?php


namespace App\Actions\User;


use App\DTO\User\CreateUserAddressData;
use App\Models\User\UserAddress;

class UserAddressAction
{
    public function create(CreateUserAddressData $addressData)
    {
        $address = UserAddress::create([
            'user_id' => $addressData->user_id,
            'street' => $addressData->street,
            'city' => $addressData->city,
            'state' => $addressData->state,
            'zip_code' => $addressData->zip_code,
        ]);

        return $address;
    }
}
