<?php


namespace App\Http\Controllers\Dealer;


use App\Http\Controllers\Controller;
use App\Http\Requests\Dealer\DealerSetPhysicalSimsByRangeRequest;
use App\Http\Requests\Users\CreateUserAddressRequest;
use App\Http\Requests\Users\CreateUserRequest;
use App\Models\Sim\Sim;
use App\Models\Sim\SimOrder;
use App\Models\User;

class DealerController extends Controller
{
    public function index()
    {
        $users = User::where([
            'role' => User::USER_ROLE_DEALER,
        ])
            ->orderBy('first_name')->paginate(20);

        return $users;
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

    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => (int)$request->get('role')
        ]);

        return $user;
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
}
