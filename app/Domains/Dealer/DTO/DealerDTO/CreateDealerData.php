<?php


namespace App\Domains\Dealer\DTO\DealerDTO;


use Spatie\DataTransferObject\DataTransferObject;

class CreateDealerData extends DataTransferObject
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $password;
    public int $role;
}
