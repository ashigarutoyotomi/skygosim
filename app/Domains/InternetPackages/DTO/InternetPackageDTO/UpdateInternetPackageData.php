<?php

namespace App\Domains\InternetPackages\DTO\InternetPackageDTO;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateInternetPackageData extends DataTransferObject
{
    public int $id;
    public string $package_id;
    public string $name_en;
    public string $name_cn;
    public string $name_hk;
    public string $desc_en;
    public string $desc_cn;
    public string $desc_hk;
    public array $card_pools;
    public int $status;
    public int $type;
    public int $period_type;
    public int $period;
    public string $imgurl;
    public string $price_usd;
    public string $price_cny;
    public string $price_hkd;
    public array $refueling_package;
    public string $activation_mode;
}
