<?php

namespace App\Domains\User\Models;

use App\Domains\InternetPackages\Models\InternetPackage;
use App\Domains\InternetPackages\Models\InternetPackageFromApi;
use App\Domains\InternetPackages\Models\InternetPackageFromFile;
use App\Domains\Sim\Models\Sim;
use Illuminate\Database\Eloquent\Model;

class UserInternetPackage extends Model
{
    protected $table = 'user_internet_packages';

    protected $fillable = [
        'user_id',
        'sim_id',
        'internet_package_id',
        'bought_price',
        'internet_package_from_type',
        'activated_from_type',
    ];

    const INTERNET_PACKAGE_FROM_TYPE_FILE = 1;
    const INTERNET_PACKAGE_FROM_TYPE_API = 2;

    const ACTIVATED_FROM_TYPE_WEB = 1;
    const ACTIVATED_FROM_TYPE_DASHBOARD = 2;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sim()
    {
        return $this->belongsTo(Sim::class, 'sim_id');
    }

    public function internet_package()
    {
        return $this->belongsTo(InternetPackage::class, 'internet_package_id');
    }

    public function internet_package_from_file()
    {
        return $this->belongsTo(InternetPackageFromFile::class, 'internet_package_id');
    }

    public function internet_package_from_api()
    {
        return $this->belongsTo(InternetPackageFromApi::class, 'internet_package_id');
    }
}
