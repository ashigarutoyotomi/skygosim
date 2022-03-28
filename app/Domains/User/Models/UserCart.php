<?php


namespace App\Domains\User\Models;


use App\Domains\InternetPackages\Models\InternetPackage;
use App\Models\Sim\Sim;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    protected $table = 'user_carts';

    protected $fillable = [
        'user_id',
        'item_type',
        'item_id',
        'sim_id',
        'quantity',
        'currency',
        'price',
        'status',
    ];

    const ITEM_TYPE_INTERNET_PACKAGE = 1; // Internet package
    const ITEM_TYPE_INTERNET_PACKAGE_FROM_FILE = 2; // Internet package from file

    const CURRENCY_USD = 1; // USD

    const CART_STATUS_NEW = 1; // New
    const CART_STATUS_ORDER = 2; // In order
    const CART_STATUS_FINISHED = 3; // Finished

    public function sim()
    {
        return $this->belongsTo(Sim::class, 'sim_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
