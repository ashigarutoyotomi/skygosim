<?php


namespace App\Models\User;


use App\Models\User;
use App\Models\User\Sim\Sim;
use Illuminate\Database\Eloquent\Model;

class UserSim extends Model
{
    protected $table = 'user_sims';

    protected $fillable = [
        'user_id',
        'sim_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sim()
    {
        return $this->belongsTo(Sim::class, 'sim_id');
    }
}
