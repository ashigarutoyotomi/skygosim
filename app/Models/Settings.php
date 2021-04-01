<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'section',
        'title',
        'type',
        'value',
    ];

    const ID_INTERNET_PACKAGE_PRICE_PERCENTAGE = 1; // PACKAGE PRICE PERCENTAGE

    const SECTION_INTERNET_PACKAGES = 'internet_packages';

    const TYPE_NUMBER = 'number';
}
