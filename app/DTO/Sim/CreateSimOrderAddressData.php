<?php


namespace App\DTO\Sim;


use Spatie\DataTransferObject\DataTransferObject;

class CreateSimOrderAddressData extends DataTransferObject
{
    /**
     * @var integer
     */
    public $sim_order_id;

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
