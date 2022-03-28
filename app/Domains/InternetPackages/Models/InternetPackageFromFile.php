<?php

namespace App\Domains\InternetPackages\Models;

use Illuminate\Database\Eloquent\Model;

class InternetPackageFromFile extends Model
{
    protected $table = 'internet_packages_from_file';

    protected $fillable = [
        'price_usd',
        'price_cny',
        'price_hkd',
        'area_chn',
        'area_eng',
        'destination_chn',
        'destination_eng',
        'days',
        'data_chn',
        'data_eng',
        'package_name_chn',
        'package_name_eng',
        'package_id',
        'validity_period',
        'price_yen',
        'admin_package_id',
        'on_sale_channel_type'
    ];
}
