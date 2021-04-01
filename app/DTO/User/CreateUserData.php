<?php


namespace App\DTO\User;


use Spatie\DataTransferObject\DataTransferObject;

class CreateUserData extends DataTransferObject
{
    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var int
     */
    public $role;

    /**
     * @var bool|null
     */
    public $send_to_email;
}
