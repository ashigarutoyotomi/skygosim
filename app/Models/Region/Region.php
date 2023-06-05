<?php


namespace App\Models\Region;


use App\Models\Countries\Country;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    protected $fillable = [
        'name',
        'tag',
    ];

    public function countries()
    {
        return $this->hasMany(Country::class, 'region_id');
    }
}
