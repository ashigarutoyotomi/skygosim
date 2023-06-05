<?php


namespace App\Models\Pages;


use App\Models\Countries\Country;
use Illuminate\Database\Eloquent\Model;

class Apn extends Model
{
    protected $table = 'page_apns';

    protected $fillable = [
        'country_id',
        'operator',
        'apn'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
