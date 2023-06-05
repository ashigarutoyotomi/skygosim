<?php


namespace App\Domains\InternetPackages\Gateways;


use App\Classes\Helpers\StringHelper;
use App\Domains\InternetPackages\Models\InternetPackage;
use App\Domains\InternetPackages\Models\InternetPackageFromApi;
use App\Domains\InternetPackages\Models\InternetPackageFromFile;
use App\Domains\Settings\Gateways\SettingGateway;
use App\Domains\Settings\Models\Setting;
use App\Traits\BasicGatewaysTrait;

class InternetPackageGateway
{
    use BasicGatewaysTrait;

    public function getInternetPackages()
    {
        $query = InternetPackage::query();

        $query
            ->orderBy('name_en')
            ->orderBy('price_usd');

        if ($this->with) {
            return $query->with($this->with);
        }

        if ($this->paginate) {
            return $query->paginate($this->paginate);
        }

        return $query->get();
    }

    public function getPackagesFromApi()
    {
        $query = InternetPackageFromApi::query();

        if ($this->paginate) {
            return $query->paginate($this->paginate);
        }

        return $query->get();
    }

    public function getPackagesFromFile()
    {
        $query = InternetPackageFromFile::orderBy('destination_eng')
            ->orderBy('price_usd');

        if ($this->paginate) {
            return $query->paginate($this->paginate);
        }

        return $query->get();
    }

    public function getSimApiPackages()
    {
        $internetPackages = [];
        $client = new \GuzzleHttp\Client();

        $endpoint = config('services.sim_api.get_access_token');
        $response = $client->request('GET', $endpoint);

        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        if ($statusCode === 200) {
            $content = json_decode($body->getContents(), true);

            $endpoint = config('services.sim_api.get_data_bundle');
            $requestBody = [
                'accessToken' => $content['accessToken'],
            ];

            $response = $client->request('POST', $endpoint, ['form_params' => $requestBody]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $content = json_decode($body->getContents(), true);

            $internetPackages = $content['dataBundles'];
        }

        return $internetPackages;
    }

    public function getPackageFromApiById(int $id)
    {
        return InternetPackageFromApi::find($id);
    }

    /**
     * Set gtt price
     * @param bool $value
     * @return $this
     */
    public function toggleGTTPrice(bool $value)
    {
        $this->gttPrices = $value;
        return $this;
    }

    public function getPaginatedInternetPackages()
    {
        $internetPackages = InternetPackage::whereNull('expired_at')
            ->orderBy('area_eng')
            ->paginate(20);

        if($this->gttPrices) {
            $this->setGttPrices($internetPackages->items());
        }

        return $internetPackages;
    }

    public function getAllInternetPackages()
    {
        $internetPackages = [];

        $whichPackages = (new SettingGateway)->getSettingValueById(Setting::ID_WHICH_INTERNET_PACKAGES_USE);

        switch ($whichPackages) {
            case "file":
                $query = InternetPackageFromFile::orderBy('destination_eng');

                if ($this->search['keywords'] && count($this->search['columns'])) {
                    $this->appendSearch($query);
                }

                $internetPackages = $query->get();
                break;
            case "api":
                $internetPackages = InternetPackageFromApi::all();
                break;
        }

        $percentage = (new SettingGateway)->getSettingValueById(Setting::ID_INTERNET_PACKAGE_PRICE_PERCENTAGE);

        foreach ($internetPackages as $key => $package) {
            switch ($whichPackages) {
                case "file":
                    $price = $package->price_usd;
                    $percentPrice = (floatval($price) * floatval($percentage)) / 100;
                    $internetPackages[$key]['gtt_price'] = round($price + $percentPrice, 2, PHP_ROUND_HALF_UP);
                    $internetPackages[$key]['imgurl'] = '/images/regions/' . strtolower(str_replace(' ', '', $package->area_eng)) . '.jpg';
                    break;
                case "api":
                    $priceKey = array_search('840', array_column($package->priceInfo, 'currencyCode'));
                    $price = $package->priceInfo[$priceKey]['price'] / 100;
                    $percentPrice = (floatval($price) * floatval($percentage)) / 100;
                    $internetPackages[$key]['gtt_price'] = round($price + $percentPrice, 2, PHP_ROUND_HALF_UP);

                    $nameInfo = collect($package->name);

                    foreach ($nameInfo as $item) {
                        if ($item['langInfo']['language'] === 'en') {
                            $internetPackages[$key]['destination_eng'] = $item['value'];
                        }
                    }
                    break;
            }
        }

        return $internetPackages;
    }

    public function setGttPrices($packages)
    {
        $percentage = (new SettingGateway)->getSettingValueById(Setting::ID_INTERNET_PACKAGE_PRICE_PERCENTAGE);

        foreach ($packages as $package) {
            $price = $package->price_usd;
            $percentPrice = (floatval($price) * floatval($percentage)) / 100;
            $package->gtt_price = round($price + $percentPrice, 2, PHP_ROUND_HALF_UP);
        }

        return $packages;
    }

    public function setLocalImages($internetPackages)
    {
        foreach ($internetPackages as $internetPackage) {
            if (count($internetPackage['card_pools']) === 1) {
                $firstKey = array_key_first($internetPackage['card_pools']);
                $countryMccCode = $internetPackage['card_pools'][$firstKey][0]['mcc'];

                switch ($countryMccCode) {
                    case '505':
                        $internetPackage['imgurl'] = '/images/regions/australia.jpg';
                        break;
                    case '456':
                        $internetPackage['imgurl'] = '/images/regions/cambodia.jpg';
                        break;
                    case '454':
                        $internetPackage['imgurl'] = '/images/regions/hongkong.jpg';
                        break;
                    case '510':
                        $internetPackage['imgurl'] = '/images/regions/indonesia.jpg';
                        break;
                    case '440':
                        $internetPackage['imgurl'] = '/images/regions/japan.jpg';
                        break;
                    case '455':
                        $internetPackage['imgurl'] = '/images/regions/macao.jpg';
                        break;
                    case '530':
                        $internetPackage['imgurl'] = '/images/regions/newzealand.jpg';
                        break;
                    case '525':
                        $internetPackage['imgurl'] = '/images/regions/singapore.jpg';
                        break;
                    case '450':
                        $internetPackage['imgurl'] = '/images/regions/SouthKorea.jpg';
                        break;
                    case '466':
                        $internetPackage['imgurl'] = '/images/regions/Taiwan.jpg';
                        break;
                    case '520':
                        $internetPackage['imgurl'] = '/images/regions/Thailand.jpg';
                        break;
                    case '424':
                        $internetPackage['imgurl'] = '/images/regions/uae.png';
                        break;
                    case '310':
                        $internetPackage['imgurl'] = '/images/regions/usa.jpg';
                        break;
                    default:
                        $internetPackage['imgurl'] = $countryMccCode;
                }
            } else {
                $cardPoolsMccs = [];
                foreach ($internetPackage['card_pools'] as $key => $cardPool) {
                    foreach ($internetPackage['card_pools'][$key] as $mcc) {
                        $cardPoolsMccs[] = $mcc['mcc'];
                    }
                }

                if (count(['310$', '302', '310']) === count($cardPoolsMccs) && !array_diff(['310$', '302', '310'], $cardPoolsMccs)) {
                    $internetPackage['imgurl'] = '/images/regions/canada.png';
                } else if (count(['310$', '310']) === count($cardPoolsMccs) && !array_diff(['310$', '310'], $cardPoolsMccs)) {
                    $internetPackage['imgurl'] = '/images/regions/usa.jpg';
                } else if (count(['502', '520', '525']) === count($cardPoolsMccs) && !array_diff(['502', '520', '525'], $cardPoolsMccs)) {
                    $internetPackage['imgurl'] = '/images/regions/singaporeandmalaysiaandthailand.jpg';
                } else if (count($cardPoolsMccs) === 147 && in_array('460', $cardPoolsMccs)) {
                    $internetPackage['imgurl'] = '/images/regions/multiregional.jpg';
                } else if (count($cardPoolsMccs) === 146) {
                    $internetPackage['imgurl'] = '/images/regions/multiregionchinaexcluded.jpg';
                } else if (count(['455', '454', '460']) === count($cardPoolsMccs) && !array_diff(['455', '454', '460'], $cardPoolsMccs)) {
                    $internetPackage['imgurl'] = '/images/regions/hongkongandmacau.jpg';
                } else if (count(['455', '454']) === count($cardPoolsMccs) && !array_diff(['455', '454'], $cardPoolsMccs)) {
                    $internetPackage['imgurl'] = '/images/regions/hongkongandmacau.jpg';
                } else if (count(['455', '454', '460', '466']) === count($cardPoolsMccs) && !array_diff(['455', '454', '460', '466'], $cardPoolsMccs)) {
                    $internetPackage['imgurl'] = '/images/regions/greaterchina.jpg';
                } else if (count($cardPoolsMccs) === 41 || count($cardPoolsMccs) === 40) {
                    $internetPackage['imgurl'] = '/images/regions/europe.jpg';
                } else if (count($cardPoolsMccs) === 15) {
                    $internetPackage['imgurl'] = '/images/regions/asia.jpg';
                }
            }
        }

        return $internetPackages;
    }
}
