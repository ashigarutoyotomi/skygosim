<?php


namespace App\DTO\Sim;


use Spatie\DataTransferObject\DataTransferObject;

class CreateSimOrderData extends DataTransferObject
{
    public int $user_id;

    public ?int $sim_id;

    public int $sim_type;

    public string $key;

    public ?int $status;
}
