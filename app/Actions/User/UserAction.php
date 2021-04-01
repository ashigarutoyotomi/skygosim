<?php


namespace App\Actions\User;


use App\DTO\User\CreateUserData;
use App\Mail\UserCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserAction
{
    public function create(CreateUserData $userData)
    {
        $user = User::create([
            'first_name' => $userData->first_name,
            'last_name' => $userData->last_name,
            'email' => $userData->email,
            'password' => bcrypt($userData->password),
            'role' => $userData->role,
        ]);

        if ($userData->send_to_email) {
            Mail::to($user->email)->send(new UserCreatedMail($userData));
        }

        return $user;
    }
}
