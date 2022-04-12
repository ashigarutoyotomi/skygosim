<?php


namespace App\Domains\User\Actions;

use App\Domains\User\DTO\UserDTO\CreateUserData;
use App\Models\User;

class UserAction
{
    public function create(CreateUserData $data)
    {
        return User::create([
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'email' => $data->email,
            'password' => $data->password,
            'role' => $data->role,
            'creator_id' => $data->creator_id,
        ]);
    }
}
