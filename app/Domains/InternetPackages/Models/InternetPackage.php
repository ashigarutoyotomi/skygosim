<?php

namespace App\Domains\InternetPackages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternetPackage extends Model
{
    use SoftDeletes;

    protected $table = 'internet_packages';

    protected $fillable = [
        'package_id',
        'name_en',
        'name_cn',
        'name_hk',
        'desc_en',
        'desc_cn',
        'desc_hk',
        'card_pools',
        'status',
        'type',
        'period_type',
        'period',
        'imgurl',
        'price_usd',
        'price_cny',
        'price_hkd',
        'refueling_package',
        'activation_mode',
    ];

    protected $casts = [
        'card_pools' => 'array',
        'refueling_package' => 'array',
    ];
}
