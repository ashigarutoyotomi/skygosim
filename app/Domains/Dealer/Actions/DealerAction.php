<?php

namespace App\Domains\Dealer\Actions;

use App\Domains\Dealer\DTO\DealerDTO\CreateDealerData;
use App\Domains\Dealer\DTO\DealerDTO\UpdateDealerData;
use App\Models\User;

class DealerAction
{
    public function create(CreateDealerData $data)
    {
        return User::create([
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'email' => $data->email,
            'password' => $data->password,
            'role' => $data->role,
        ]);
    }

    public function update(UpdateDealerData $data)
    {
        $dealer = User::find($data->dealer_id);

        abort_unless($dealer, 404, 'Dealer not found');

        $dealer->first_name = $data->first_name;
        $dealer->last_name = $data->last_name;
        $dealer->email = $data->email;

        if ($data->password) {
            $dealer->password = $data->password;
        }

        $dealer->save();

        return $dealer;
    }
}
