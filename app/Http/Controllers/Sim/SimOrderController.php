<?php


namespace App\Http\Controllers\Sim;


use App\Http\Controllers\Controller;
use App\Models\Sim\Sim;
use App\Models\Sim\SimOrder;
use Illuminate\Http\Request;

class SimOrderController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type');
        $query = SimOrder::with('user', 'sim')
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc');

        if ($type && $type === 'physical') {
            $query->where('sim_type', SimOrder::SIM_TYPE_PHYSICAL);
        } else if ($type && $type === 'e-sim') {
            $query->where('sim_type', SimOrder::SIM_TYPE_E_SIM);
        }

        return $query->paginate(20);
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
