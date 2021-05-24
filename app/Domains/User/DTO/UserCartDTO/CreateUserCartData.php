<?php


namespace App\Domains\User\DTO\UserCartDTO;


use Spatie\DataTransferObject\DataTransferObject;

class CreateUserCartData extends DataTransferObject
{
    public int $user_id;
    public int $item_type;
    public int $item_id;
    public ?int $sim_id;
    public int $quantity;
    public int $currency;
    public float $price;
    public int $status;
}
