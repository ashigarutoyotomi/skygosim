<?php


namespace App\DTO\Sim;


use Spatie\DataTransferObject\DataTransferObject;

class CreateSimOrderAddressData extends DataTransferObject
{
    public int $sim_order_id;

    public string $street;

    public string $city;

    public string $state;

    public string $zip_code;
}
