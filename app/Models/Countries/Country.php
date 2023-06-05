<?php


namespace App\Models\Countries;


use App\Models\Pages\Apn;
use App\Models\Region\Region;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'region_id',
        'name',
        'tag',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function apns()
    {
        return $this->hasMany(Apn::class, 'country_id');
    }
}
