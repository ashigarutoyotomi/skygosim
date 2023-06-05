<?php


namespace App\DTO\User;


use Spatie\DataTransferObject\DataTransferObject;

class CreateUserData extends DataTransferObject
{
    public string $first_name;

    public string $last_name;

    public string $email;

    public string $password;

    public int $role;

    public ?bool $send_to_email;
}
