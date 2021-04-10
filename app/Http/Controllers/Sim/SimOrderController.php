<?php


namespace App\Http\Controllers\Sim;


use App\Http\Controllers\Controller;
use App\Models\Sim\SimOrder;
use Illuminate\Http\Request;

class SimOrderController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type');
        $query = SimOrder::with('user', 'sim')
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
}
