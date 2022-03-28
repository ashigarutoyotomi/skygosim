<?php

namespace App\Domains\InternetPackages\Actions;

use App\Domains\InternetPackages\DTO\InternetPackageFromApiDTO\CreateInternetPackageFromApiData;
use App\Domains\InternetPackages\DTO\InternetPackageFromApiDTO\UpdateInternetPackageFromApiData;
use App\Domains\InternetPackages\Gateways\InternetPackageGateway;
use App\Domains\InternetPackages\Models\InternetPackageFromApi;

class InternetPackageAction
{
    public function createPackageFromApi(CreateInternetPackageFromApiData $data)
    {
        return InternetPackageFromApi::create($data->toArray());
    }

    public function updatePackageFromApi(UpdateInternetPackageFromApiData $data)
    {
        $internetPackageFromApi = (new InternetPackageGateway)->getPackageFromApiById($data->id);

        abort_unless(!!$internetPackageFromApi, 404, 'Package from API not found');

        $internetPackageFromApi->package_id = $data->package_id;
        $internetPackageFromApi->name = $data->name;
        $internetPackageFromApi->desc = $data->desc;
        $internetPackageFromApi->status = $data->status;
        $internetPackageFromApi->cardPools = $data->cardPools;
        $internetPackageFromApi->type = $data->type;
        $internetPackageFromApi->periodType = $data->periodType;
        $internetPackageFromApi->period = $data->period;
        $internetPackageFromApi->imgurl = $data->imgurl;
        $internetPackageFromApi->priceInfo = $data->priceInfo;
        $internetPackageFromApi->refuelingPackage = $data->refuelingPackage;
        $internetPackageFromApi->createTime = $data->createTime;
        $internetPackageFromApi->expireTime = $data->expireTime;
        $internetPackageFromApi->lastModifyTime = $data->lastModifyTime;
        $internetPackageFromApi->originalPriceInfo = $data->originalPriceInfo;
        $internetPackageFromApi->ext = $data->ext;

        $internetPackageFromApi->save();

        return $internetPackageFromApi;
    }
}
