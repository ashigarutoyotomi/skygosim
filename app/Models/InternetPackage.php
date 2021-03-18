<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class InternetPackage extends Model
{
    protected $table = 'internet_packages';

    protected $fillable = [
        'package_id',
        'gtt_price_usd',
        'price_usd',
        'price_cny',
        'price_hkd',
        'price_yen',
        'area_eng',
        'destination_eng',
        'data_eng',
        'package_name_eng',
        'days',
        'validity_period',
    ];
}
