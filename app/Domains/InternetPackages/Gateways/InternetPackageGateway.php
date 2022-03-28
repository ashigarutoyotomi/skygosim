<?php


namespace App\Domains\InternetPackages\Gateways;


use App\Classes\Helpers\StringHelper;
use App\Domains\InternetPackages\Models\InternetPackageFromApi;
use App\Domains\InternetPackages\Models\InternetPackageFromFile;
use App\Domains\Settings\Gateways\SettingGateway;
use App\Domains\Settings\Models\Setting;
use App\Traits\BasicGatewaysTrait;

class InternetPackageGateway
{
    use BasicGatewaysTrait;

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
        $query = InternetPackageFromFile::query();

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
        $internetPackages = InternetPackageFromFile::all();

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
}
