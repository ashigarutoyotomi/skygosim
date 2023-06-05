<?php


namespace App\Actions\Sim;


use App\DTO\Sim\CreateSimOrderData;
use App\Mail\Sim\ESimOrderMail;
use App\Mail\Sim\PhysicalSimOrderMail;
use App\Models\Sim\Sim;
use App\Models\Sim\SimOrder;
use Illuminate\Support\Facades\Mail;

class SimOrderAction
{
    public function create(CreateSimOrderData $simOrderData)
    {
        $simOrder = SimOrder::create([
            'user_id' => $simOrderData->user_id,
            'sim_id' => $simOrderData->sim_id ?? null,
            'sim_type' => $simOrderData->sim_type,
            'status' => $simOrderData->status,
            'key' => $simOrderData->key,
        ]);

        return $simOrder;
    }
}
