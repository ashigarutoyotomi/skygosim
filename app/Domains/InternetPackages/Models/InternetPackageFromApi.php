<?php

namespace App\Domains\InternetPackages\Models;

use Illuminate\Database\Eloquent\Model;

class InternetPackageFromApi extends Model
{
    protected $table = 'internet_packages_from_api';

    protected $fillable = [
        'package_id',
        'name',
        'desc',
        'cardPools',
        'status',
        'type',
        'periodType',
        'period',
        'imgurl',
        'priceInfo',
        'refuelingPackage',
        'createTime',
        'expireTime',
        'lastModifyTime',
        'originalPriceInfo',
        'ext',
    ];

    protected $casts = [
        'name' => 'array',
        'desc' => 'array',
        'cardPools' => 'array',
        'priceInfo' => 'array',
        'refuelingPackage' => 'array',
        'originalPriceInfo' => 'array',
        'ext' => 'array',
    ];
}
