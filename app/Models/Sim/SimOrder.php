<?php


namespace App\Models\Sim;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SimOrder extends Model
{
    protected $table = 'sim_orders';

    protected $fillable = [
        'user_id',
        'sim_id',
        'sim_type',
        'status',
    ];

    const SIM_TYPE_PHYSICAL = 1; // Physical sim type
    const SIM_TYPE_E_SIM = 2; // E-SIM type

    const STATUS_NEW = 1; // Order status new
    const STATUS_IN_PROCESS = 2; // Order status in process
    const STATUS_FINISHED = 3; // Order status finished

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sim()
    {
        return $this->belongsTo(Sim::class, 'sim_id');
    }
}
