<?php


namespace App\Http\Controllers\Sim;


use App\Http\Controllers\Controller;
use App\Http\Requests\SimCard\UploadSimCardsFileRequest;
use App\Imports\SimImport;
use App\Models\Sim\Sim;
use Maatwebsite\Excel\Facades\Excel;

class SimController extends Controller
{
    public function index()
    {
        $simCards = Sim::orderBy('iccid')->paginate(20);

        return $simCards;
    }

    public function uploadSimCards(UploadSimCardsFileRequest $request)
    {
        Excel::import(new SimImport, $request->file);

        return true;
    }
}
