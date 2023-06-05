<?php


namespace App\Models\Sim;


use Illuminate\Database\Eloquent\Model;

class SimOrderAddress extends Model
{
    protected $table = 'sim_order_addresses';

    protected $fillable = [
        'sim_order_id',
        'street',
        'city',
        'state',
        'zip_code',
    ];

    public function sim()
    {
        return $this->belongsTo(Sim::class, 'sim_id');
    }
}
