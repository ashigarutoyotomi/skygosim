<?php


namespace App\Domains\User\Gateways;


use App\Models\Sim\SimOrder;
use App\Models\User;
use Carbon\Carbon;

class UserGateway
{
    protected $filters = [];
    protected $keywords = '';
    protected $with = null;
    protected $paginate = null;
    protected $limit = null;
    protected $userRole = null;


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
     * Paginate.
     *
     * @param int $paginate
     * @return $this
     */
    public function paginate(int $paginate)
    {
        $this->paginate = $paginate;
        return $this;
    }

    /**
     * Set user role.
     *
     * @param int $paginate
     * @return $this
     */
    public function setRole(int $role)
    {
        $this->userRole = $role;
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

    public function getUsers() {
        $users = User::all();

        return $users;
    }

    public function getCustomers() {
        $query = User::where('role', User::USER_ROLE_USER);

        if ($this->paginate) {
            return $query->paginate($this->paginate);
        }

        return $query->get();
    }

    public function getCustomersForDealer(int $dealer_id) {
        $query = User::where('role', User::USER_ROLE_USER)
            ->where('creator_id', $dealer_id);

        if ($this->paginate) {
            return $query->paginate($this->paginate);
        }

        return $query->get();
    }

    public function getCustomersDataForWidget(?int $dealer_id)
    {
        $query = User::where([
            'role' => User::USER_ROLE_USER,
        ]);

        if ($this->with) {
            $query->with($this->with);
        }

        if ($this->userRole === User::USER_ROLE_DEALER) {
            $query->where('creator_id', $dealer_id);
        }

        return $query->get();
    }

    public function getUserPhysicalSimOrders()
    {
        $query = SimOrder::where('sim_type', SimOrder::SIM_TYPE_PHYSICAL)
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc');

        if ($this->with) {
            $query->with($this->with);
        }

        if ($this->filters) {
            if (array_key_exists('date_from', $this->filters) && $this->filters['date_from']) {
                $date = Carbon::parse($this->filters['date_from'])->toDateTimeString();
                $query->where('created_at', '>=', $date);
            }

            if (array_key_exists('date_to', $this->filters) && $this->filters['date_to']) {
                $date = Carbon::parse($this->filters['date_to'])
                    ->toDateTimeString();
                $query->where('created_at', '<=', $date);
            }
        }

        if ($this->paginate) {
            return $query->paginate($this->paginate);
        }

        return $query->get();
    }

    public function getUserESimOrders()
    {
        $query = SimOrder::where('sim_type', SimOrder::SIM_TYPE_E_SIM)
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc');

        if ($this->with) {
            $query->with($this->with);
        }

        if ($this->filters) {
            if (array_key_exists('date_from', $this->filters) && $this->filters['date_from']) {
                $date = Carbon::parse($this->filters['date_from'])->toDateTimeString();
                $query->where('created_at', '>=', $date);
            }

            if (array_key_exists('date_to', $this->filters) && $this->filters['date_to']) {
                $date = Carbon::parse($this->filters['date_to'])
                    ->toDateTimeString();
                $query->where('created_at', '<=', $date);
            }
        }

        if ($this->paginate) {
            return $query->paginate($this->paginate);
        }

        return $query->get();
    }
}
