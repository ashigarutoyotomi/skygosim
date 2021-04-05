<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;
use App\Http\Requests\Sim\AddSimRequest;
use App\Models\Sim\Sim;
use App\Models\User\UserSim;
use Illuminate\Support\Facades\Auth;

class AddSimPageController extends Controller
{
    public function index()
    {
        return view('add-sim');
    }

    public function addSim(AddSimRequest $request)
    {
        $sim = Sim::where([
            'iccid' => $request->get('iccid'),
            'pin_2' => $request->get('code'),
        ])->first();

        abort_unless($sim, 404, "Sim card doesn't exist");

        $user = Auth::user();

        $userSim = UserSim::firstOrCreate([
            'user_id' => $user->id,
            'sim_id' => $sim->id,
        ]);

        return $userSim;
    }
}
