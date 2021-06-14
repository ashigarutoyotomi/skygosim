<?php


namespace App\Http\Controllers\Dealer;


use App\Domains\Dealer\Actions\DealerAction;
use App\Domains\Dealer\DTO\DealerDTO\CreateDealerData;
use App\Domains\Dealer\DTO\DealerDTO\UpdateDealerData;
use App\Domains\Dealer\Gateways\DealerGateway;
use App\Domains\User\Models\UserCart;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dealer\CreateDealerRequest;
use App\Http\Requests\Dealer\DealerSetPhysicalSimsByRangeRequest;
use App\Http\Requests\Dealer\UpdateDealerRequest;
use App\Http\Requests\Users\CreateUserAddressRequest;
use App\Models\Sim\Sim;
use App\Models\Sim\SimOrder;
use App\Models\User;

class DealerController extends Controller
{
    public function index()
    {
        $dealerGateway = new DealerGateway;

        return $dealerGateway->getPaginatedDealers();
    }

    public function all()
    {
        $dealerGateway = new DealerGateway;

        return $dealerGateway->getAllDealersWithFullName();
    }

    public function getPhysicalSims($dealer_id)
    {
        $sims = Sim::where([
            'sim_type' => Sim::SIM_TYPE_PHYSICAL,
            'dealer_id' => $dealer_id,
        ])
            ->orderBy('iccid')
            ->paginate(20);

        return $sims;
    }

    public function getPhysicalSimOrders($dealer_id)
    {
        $orders = SimOrder::select('sim_orders.*')
            ->with(['user'])
            ->leftJoin('sims', 'sim_orders.sim_id', 'sims.id')
            ->where('sims.dealer_id', $dealer_id)
            ->where('sim_orders.sim_type', SimOrder::SIM_TYPE_PHYSICAL)
            ->distinct()
            ->paginate(20);

        return $orders;
    }

    public function store(CreateDealerRequest $request)
    {
        $userData = new CreateDealerData([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => User::USER_ROLE_DEALER,
        ]);

        return (new DealerAction)->create($userData);
    }

    public function update($dealer_id, UpdateDealerRequest $request)
    {
        $dealerData = new UpdateDealerData([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'dealer_id' => (int)$dealer_id,
        ]);

        return (new DealerAction)->update($dealerData);
    }

    public function storeAddress(CreateUserAddressRequest $request)
    {
        $user = User::find($request->get('user_id'));
        abort_unless($user, 404, 'Dealer not found');

        $userAddress = $user->address()->create([
            'street' => $request->get('street'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip_code' => $request->get('zip_code'),
        ]);

        return $userAddress;
    }

    public function setPhysicalSims(DealerSetPhysicalSimsByRangeRequest $request)
    {
        $physicalSims = Sim::where('sim_type', Sim::SIM_TYPE_PHYSICAL)
            ->where('iccid', '>=', $request->get('from_iccid'))
            ->where('iccid', '<=', $request->get('to_iccid'))
            ->get();

        foreach ($physicalSims as $physicalSim) {
            $physicalSim->dealer_id = $request->get('dealer_id');
            $physicalSim->save();
        }

        return true;
    }

    public function cartInternetPackages($dealer_id)
    {
        $cart = UserCart::where([
            'user_id' => $dealer_id,
            'item_type' => UserCart::ITEM_TYPE_INTERNET_PACKAGE,
            'status' => UserCart::CART_STATUS_NEW,
        ])->get();

        return [
            'cart' => $cart,
            'dealerDiscount' => 10,
        ];
    }
}
