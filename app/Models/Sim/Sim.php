<?php


namespace App\Models\Sim;


use Illuminate\Database\Eloquent\Model;

class Sim extends Model
{
    protected $table = 'sims';

    protected $fillable = [
        'msisdn',
        'imsi',
        'iccid',
        'pin_2',
        'puk_1',
        'sim_type',
        'download_url',
        'sim_status',
    ];

    const SIM_TYPE_PHYSICAL = 1; // Physical sim type
    const SIM_TYPE_E_SIM = 2; // E-SIM type

    const SIM_STATUS_NEW = 1; // Order status new
    const SIM_STATUS_IN_PROCESS = 2; // Order status in process
    const SIM_STATUS_SOLD = 2; // Order status sold
}
