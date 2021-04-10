<?php


namespace App\DTO\User;


use Spatie\DataTransferObject\DataTransferObject;

class CreateUserAddressData extends DataTransferObject
{
    /**
     * @var integer
     */
    public $user_id;

    /**
     * @var string
     */
    public $street;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $state;

    /**
     * @var string
     */
    public $zip_code;
}
