<?php


namespace App\Domains\Settings\Models;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'section',
        'title',
        'type',
        'value',
    ];

    const ID_INTERNET_PACKAGE_PRICE_PERCENTAGE = 1; // PACKAGE PRICE PERCENTAGE
    const ID_PHYSICAL_SIM_ORDER_PRICE = 2; // Physical sim order price
    const ID_PHYSICAL_SIM_SHIPPING_PRICE = 3; // Physical sim shipping price
    const ID_E_SIM_ORDER_PRICE = 4; // E-SIM order price
    const ID_DISABLE_INTERNET_PACKAGES_PURCHASING = 5; // E-SIM order price

    const SECTION_MAIN = 'main';
    const SECTION_PRICES = 'prices';

    const TYPE_NUMBER = 'number';
    const TYPE_BOOLEAN = 'boolean';
}
