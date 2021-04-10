<?php


namespace App\DTO\Sim;


use Spatie\DataTransferObject\DataTransferObject;

class CreateSimOrderData extends DataTransferObject
{
    /**
     * @var integer
     */
    public $user_id;

    /**
     * @var integer|null
     */
    public $sim_id;

    /**
     * @var integer
     */
    public $sim_type;

    /**
     * @var string
     */
    public $key;

    /**
     * @var integer|null
     */
    public $status;
}
