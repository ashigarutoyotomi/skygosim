<?php


namespace App\Domains\Sim\Gateways;


use App\Classes\Helpers\StringHelper;
use App\Domains\Sim\Models\Sim;

class SimGateway
{
    protected $filters = [];
    protected $keywords = '';
    protected $with = null;

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

    public function getAvailableSims()
    {
        $simQuery = Sim::latest()
            ->where('sim_status', Sim::SIM_STATUS_NEW);

        // Search
        if (!!$this->keywords) {
            $simQuery = $this->appendSearch($simQuery);
        }

        return $simQuery->limit(20)->get();
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
                    $q->where('iccid', 'like', $like);
                });
            }
        });

        return $query;
    }
}
