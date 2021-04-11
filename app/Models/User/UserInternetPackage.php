<?php


namespace App\Models\User;


use App\Models\InternetPackage;
use App\Models\Sim\Sim;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserInternetPackage extends Model
{
    protected $table = 'user_internet_packages';

    protected $fillable = [
        'user_id',
        'sim_id',
        'internet_package_id',
        'bought_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sim()
    {
        return $this->belongsTo(Sim::class, 'sim_id');
    }

    public function internet_package()
    {
        return $this->belongsTo(InternetPackage::class, 'internet_package_id');
    }
}
