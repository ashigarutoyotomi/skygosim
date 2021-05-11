<?php


namespace App\Domains\InternetPackages\Gateways;


use App\Domains\InternetPackages\Models\InternetPackage;
use App\Domains\Settings\Gateways\SettingGateway;
use App\Domains\Settings\Models\Setting;

class InternetPackageGateway
{
    protected $filters = [];
    protected $keywords = '';
    protected $with = null;
    protected $gttPrices = false;


    /**
     * Begin querying a model with eager loading.
     *
     * @param array|string $with
     * @return $this
     */
    public function with($with)
    {
        $this->with = $with;
        return $this;
    }

    /**
     * Set filters
     * @param array|null $filters
     * @return $this
     */
    public function setFilters(?array $filters)
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * Set keywords
     * @param string|null $keywords
     * @return $this
     */
    public function setKeywords(?string $keywords)
    {
        $this->keywords = $keywords;
        return $this;
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
        $internetPackages = InternetPackage::whereNull('expired_at')
            ->orderBy('area_eng')
            ->get();

        if($this->gttPrices) {
            $this->setGttPrices($internetPackages);
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
}
