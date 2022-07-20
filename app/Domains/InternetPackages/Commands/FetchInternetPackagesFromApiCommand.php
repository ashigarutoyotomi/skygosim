<?php

namespace App\Domains\InternetPackages\Commands;

use App\Domains\InternetPackages\Actions\InternetPackageAction;
use App\Domains\InternetPackages\DTO\InternetPackageDTO\CreateInternetPackageData;
use App\Domains\InternetPackages\DTO\InternetPackageDTO\UpdateInternetPackageData;
use App\Domains\InternetPackages\Gateways\InternetPackageGateway;
use App\Domains\InternetPackages\Models\InternetPackage;
use Illuminate\Console\Command;

class FetchInternetPackagesFromApiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'internet_packages:fetch_from_api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $internetPackagesGateway = new InternetPackageGateway;
        $newInternetPackages = $internetPackagesGateway->getSimApiPackages();
        $oldInternetPackages = $internetPackagesGateway->getInternetPackages();
        $exitInternetPackageIds = [];

        foreach ($newInternetPackages as $newInternetPackage) {
            $oldInternetPackage = $oldInternetPackages->firstWhere('package_id', $newInternetPackage['id']);

            $prices = $this->getPrices($newInternetPackage);
            $names = $this->getNames($newInternetPackage);
            $descs = $this->getDescs($newInternetPackage);

            $data = [
                'package_id' => $newInternetPackage['id'],
                'name_en' => $names['name_en'],
                'name_cn' => $names['name_cn'],
                'name_hk' => $names['name_hk'],
                'desc_en' => $descs['desc_en'],
                'desc_cn' => $descs['desc_cn'],
                'desc_hk' => $descs['desc_hk'],
                'card_pools' => $newInternetPackage['cardPools'],
                'status' => $newInternetPackage['status'],
                'type' => $newInternetPackage['type'],
                'period_type' => $newInternetPackage['periodType'],
                'period' => $newInternetPackage['period'],
                'imgurl' => $newInternetPackage['imgurl'],
                'price_usd' => strval($prices['price_usd'] / 100),
                'price_cny' => strval($prices['price_cny'] / 100),
                'price_hkd' => strval($prices['price_hkd'] / 100),
                'refueling_package' => isset($newInternetPackage['refuelingPackage']) ? $newInternetPackage['refuelingPackage'] : [],
                'activation_mode' => $newInternetPackage['activationMode'],
            ];

            if ($oldInternetPackage) {
                $exitInternetPackageIds[] = $oldInternetPackage->id;
                $data['id'] = $oldInternetPackage->id;
                $data = new UpdateInternetPackageData($data);
                (new InternetPackageAction)->update($data);
            } else {
                $data = new CreateInternetPackageData($data);
                $internetPackage = (new InternetPackageAction)->create($data);
                $exitInternetPackageIds[] = $internetPackage->id;
            }
        }

        InternetPackage::whereNotIn('id', $exitInternetPackageIds)->delete();
    }

    private function getPrices($internetPackage)
    {
        $priceKey = array_search('840', array_column($internetPackage['priceInfo'], 'currencyCode'));
        $priceUsd = $internetPackage['priceInfo'][$priceKey]['price'];
        $priceKey = array_search('344', array_column($internetPackage['priceInfo'], 'currencyCode'));
        $priceHkd = $internetPackage['priceInfo'][$priceKey]['price'];
        $priceKey = array_search('156', array_column($internetPackage['priceInfo'], 'currencyCode'));
        $priceCny = $internetPackage['priceInfo'][$priceKey]['price'];

        return [
            'price_usd' => $priceUsd,
            'price_cny' => $priceCny,
            'price_hkd' => $priceHkd,
        ];
    }

    private function getNames($internetPackage)
    {
        $nameInfo = collect($internetPackage['name']);
        $nameUs = '';
        $nameHk = '';
        $nameCn = '';
        foreach ($nameInfo as $item) {
            if ($item['langInfo']['country'] === 'US') {
                $nameUs = $item['value'];
            }
            if ($item['langInfo']['country'] === 'CN') {
                $nameCn = $item['value'];
            }
            if ($item['langInfo']['country'] === 'HK') {
                $nameHk = $item['value'];
            }
        }

        return [
            'name_en' => $nameUs,
            'name_cn' => $nameCn,
            'name_hk' => $nameHk,
        ];
    }

    private function getDescs($internetPackage)
    {
        $descInfo = collect($internetPackage['desc']);
        $descEn = '';
        $descCh = '';
        $descHk = '';
        foreach ($descInfo as $item) {
            if ($item['langInfo']['country'] === 'US') {
                $descEn = $item['value'];
            }
            if ($item['langInfo']['country'] === 'CN') {
                $descCh = $item['value'];
            }
            if ($item['langInfo']['country'] === 'HK') {
                $descHk = $item['value'];
            }
        }

        return [
            'desc_en' => $descEn,
            'desc_cn' => $descCh,
            'desc_hk' => $descHk,
        ];
    }
}
