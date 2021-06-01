<?php


namespace App\Http\Controllers\Sim;


use App\Domains\Sim\Gateways\SimGateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\SimCard\UploadSimCardsFileRequest;
use App\Imports\SimImport;
use App\Models\Sim\Sim;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SimController extends Controller
{
    public function index()
    {
        $simCards = Sim::orderBy('iccid')->paginate(20);

        return $simCards;
    }

    public function getPhysicalSims()
    {
        $sims = Sim::where([
            'sim_type' => Sim::SIM_TYPE_PHYSICAL
        ])
            ->orderBy('iccid')
            ->paginate(20);

        return $sims;
    }

    public function getESims()
    {
        $simCards = Sim::where([
            'sim_type' => Sim::SIM_TYPE_E_SIM
        ])
            ->orderBy('iccid')
            ->paginate(20);

        return $simCards;
    }

    public function uploadSimCards(UploadSimCardsFileRequest $request)
    {
        Excel::import(new SimImport, $request->file);

        return true;
    }

    public function uploadSimsFromFile(UploadSimCardsFileRequest $request)
    {
        Excel::import(new SimImport, $request->file);

        return true;
    }

    public function getAvailablePhysicalSims()
    {
        $sims = Sim::where([
            'sim_type' => Sim::SIM_TYPE_PHYSICAL,
            'sim_status' => Sim::SIM_STATUS_NEW,
        ])
            ->orderBy('iccid', 'asc')
            ->limit(20)
            ->get();

        return $sims;
    }

    public function getAvailableSims(Request $request)
    {
        $keywords = $request->get('keywords');
        $filters = json_decode($request->get('filters'), true);

        $simGateway = (new SimGateway())
            ->setFilters($filters)
            ->setKeywords($keywords);

        return $simGateway->getAvailableSims();
    }
}
