<?php


namespace App\Http\Controllers\Sim;


use App\Http\Controllers\Controller;
use App\Models\Sim\SimOrder;

class SimOrderController extends Controller
{
    public function index()
    {
        return SimOrder::with('user', 'sim')
            ->orderBy('created_at', 'desc')->paginate(20);
    }
}
