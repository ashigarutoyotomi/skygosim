<?php

namespace App\Domains\User\DTO\UserDTO;

use App\Http\Requests\Users\CreateUserRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\DataTransferObject;

class CreateUserData extends DataTransferObject
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $password;
    public int $role;
    public ?int $creator_id;

    public static function fromRequest(CreateUserRequest $request): self
    {
        $user = Auth::user();

        return new self([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => (int)$request->get('role'),
            'creator_id' => $user ? $user->id : null,
        ]);
    }
}
