<?php


namespace App\Http\Controllers\Sim;


use App\Domains\User\Gateways\UserGateway;
use App\Http\Controllers\Controller;
use App\Models\Sim\Sim;
use App\Models\Sim\SimOrder;
use Illuminate\Http\Request;

class SimOrderController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type');
        $filters = json_decode($request->get('filters'), true);

        $gateway = new UserGateway();

        $gateway->with(['user', 'sim'])
            ->setFilters($filters)
            ->paginate(20);

        if ($type && $type === 'physical') {
            $orders = $gateway->getUserPhysicalSimOrders();
        } else if ($type && $type === 'e-sim') {
            $orders = $gateway->getUserESimOrders();
        }

        return $orders;
    }

    public function showPhysicalSim($sim_order_id)
    {
        $order = SimOrder::find($sim_order_id);

        $order->load([
            'address',
            'user',
            'sim',
        ]);

        return $order;
    }

    public function addPhysicalSim($sim_order_id, Request $request)
    {
        $simOrder = SimOrder::find($sim_order_id);
        abort_unless($simOrder, 404, 'Order not found');

        $simICCID = $request->get('iccid');
        $sim = Sim::where('iccid', $simICCID)->first();
        abort_unless($sim, 404, 'SIM not found');

        $simOrder->sim_id = $sim->id;
        $simOrder->status = SimOrder::STATUS_IN_PROCESS;
        $simOrder->save();

        return $simOrder;
    }

    public function finish($sim_order_id)
    {
        $simOrder = SimOrder::find($sim_order_id);
        abort_unless($simOrder, 404, 'Order not found');

        $simOrder->status = SimOrder::STATUS_FINISHED;
        $simOrder->save();

        return $simOrder;
    }
}
