<?php


namespace App\Domains\Dealer\DTO\DealerDTO;


use Spatie\DataTransferObject\DataTransferObject;

class UpdateDealerData extends DataTransferObject
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public ?string $password;
    public int $dealer_id;
}
