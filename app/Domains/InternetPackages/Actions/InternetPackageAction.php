<?php

namespace App\Domains\InternetPackages\Actions;

use App\Domains\InternetPackages\DTO\InternetPackageDTO\CreateInternetPackageData;
use App\Domains\InternetPackages\DTO\InternetPackageDTO\UpdateInternetPackageData;
use App\Domains\InternetPackages\DTO\InternetPackageFromApiDTO\CreateInternetPackageFromApiData;
use App\Domains\InternetPackages\DTO\InternetPackageFromApiDTO\UpdateInternetPackageFromApiData;
use App\Domains\InternetPackages\Gateways\InternetPackageGateway;
use App\Domains\InternetPackages\Models\InternetPackage;
use App\Domains\InternetPackages\Models\InternetPackageFromApi;

class InternetPackageAction
{
    public function create(CreateInternetPackageData $data)
    {
        return InternetPackage::create([
            'package_id' => $data->package_id,
            'name_en' => $data->name_en,
            'name_cn' => $data->name_cn,
            'name_hk' => $data->name_hk,
            'desc_en' => $data->desc_en,
            'desc_cn' => $data->desc_cn,
            'desc_hk' => $data->desc_hk,
            'card_pools' => $data->card_pools,
            'status' => $data->status,
            'type' => $data->type,
            'period_type' => $data->period_type,
            'period' => $data->period,
            'imgurl' => $data->imgurl,
            'price_usd' => $data->price_usd,
            'price_cny' => $data->price_cny,
            'price_hkd' => $data->price_hkd,
            'refueling_package' => $data->refueling_package,
            'activation_mode' => $data->activation_mode,
        ]);
    }

    public function update(UpdateInternetPackageData $data)
    {
        $internetPackage = InternetPackage::find($data->id);
        abort_unless($internetPackage, 404, 'Internet package not found');

        $internetPackage->package_id = $data->package_id;
        $internetPackage->name_en = $data->name_en;
        $internetPackage->name_cn = $data->name_cn;
        $internetPackage->name_hk = $data->name_hk;
        $internetPackage->desc_en = $data->desc_en;
        $internetPackage->desc_cn = $data->desc_cn;
        $internetPackage->desc_hk = $data->desc_hk;
        $internetPackage->card_pools = $data->card_pools;
        $internetPackage->status = $data->status;
        $internetPackage->type = $data->type;
        $internetPackage->period_type = $data->period_type;
        $internetPackage->period = $data->period;
        $internetPackage->imgurl = $data->imgurl;
        $internetPackage->price_usd = $data->price_usd;
        $internetPackage->price_cny = $data->price_cny;
        $internetPackage->price_hkd = $data->price_hkd;
        $internetPackage->refueling_package = $data->refueling_package;
        $internetPackage->activation_mode = $data->activation_mode;

        $internetPackage->save();

        return $internetPackage;
    }

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
