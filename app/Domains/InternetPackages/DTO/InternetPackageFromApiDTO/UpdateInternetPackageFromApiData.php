<?php

namespace App\Domains\InternetPackages\DTO\InternetPackageFromApiDTO;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateInternetPackageFromApiData extends DataTransferObject
{
    public int $id;

    public string $package_id;

    public array $name;

    public array $desc;

    public array $cardPools;

    public int $status;

    public int $type;

    public int $periodType;

    public int $period;

    public string $imgurl;

    public array $priceInfo;

    public array $refuelingPackage;

    public string $createTime;

    public string $expireTime;

    public string $lastModifyTime;

    public array $originalPriceInfo;

    public array $ext;
}
