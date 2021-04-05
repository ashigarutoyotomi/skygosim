<?php


namespace App\Gateways\Sim;


use App\Models\User\Sim\Sim;

class SimGateway
{
    public function getNewESim()
    {
        return Sim::where([
            'sim_type' => Sim::SIM_TYPE_E_SIM,
            'sim_status' => Sim::SIM_STATUS_NEW,
        ])->first();
    }
}
