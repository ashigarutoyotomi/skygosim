<?php


namespace App\Domains\Dealer\Gateways;


use App\Models\User;

class DealerGateway
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

    public function getPaginatedDealers()
    {
        return User::where([
            'role' => User::USER_ROLE_DEALER,
        ])
            ->orderBy('first_name')->paginate(20);
    }

    public function getAllDealersWithFullName()
    {
        $dealers = User::where([
            'role' => User::USER_ROLE_DEALER,
        ])
            ->orderBy('first_name')->get();

        return $dealers->map(function($user) {
            $user->full_name = $user->first_name . ' ' . $user->last_name;

            return $user;
        });
    }
}
