<?php


namespace App\Actions\Sim;


use App\DTO\Sim\CreateSimOrderAddressData;
use App\Models\Sim\SimOrderAddress;

class SimOrderAddressAction
{
    public function create(CreateSimOrderAddressData $data)
    {
        return SimOrderAddress::create([
            'sim_order_id' => $data->sim_order_id,
            'street' => $data->street,
            'city' => $data->city,
            'state' => $data->state,
            'zip_code' => $data->zip_code,
        ]);
    }
}
