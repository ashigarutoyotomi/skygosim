<?php


namespace App\Domains\InternetPackages\Gateways;


use App\Classes\Helpers\StringHelper;
use App\Domains\InternetPackages\Models\InternetPackage;
use App\Domains\Settings\Gateways\SettingGateway;
use App\Domains\Settings\Models\Setting;

class InternetPackageGateway
{
    protected $filters = [];
    protected $keywords = '';
    protected $with = null;
    protected $gttPrices = false;
    protected $limit = null;


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
     * Set limit.
     *
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit)
    {
        $this->limit = $limit;
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

    public function getPackages()
    {
        $query = InternetPackage::whereNull('expired_at');

        // Search
        if (!!$this->keywords) {
            $query = $this->appendSearch($query);
        }

        // Limit
        if (!!$this->limit) {
            $query->limit($this->limit);
        }

        return $query->get();
    }

    /**
     * Append search
     * @param $query
     * @return mixed
     */
    private function appendSearch($query)
    {
        $keywords = $this->keywords;

        $query->where(function ($q) use ($keywords) {
            $keywordParts = preg_split('/ /', $keywords, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($keywordParts as $index => $possiblePart) {
                $like = "%" . StringHelper::escapeLike($possiblePart) . "%";
                $whereClause = $index == 0 ? 'where' : 'orWhere';
                $q->$whereClause(function ($q) use ($like) {
                    $q->where('package_id', 'like', $like);
                });
            }
        });

        return $query;
    }
}
