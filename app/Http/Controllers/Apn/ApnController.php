<?php


namespace App\Http\Controllers\Apn;


use App\Http\Controllers\Controller;
use App\Http\Requests\Apn\CreateApnRequest;
use App\Models\Pages\Apn;

class ApnController extends Controller
{
    public function index()
    {
        return Apn::with('country')->paginate(20);
    }

    public function show($country_id)
    {
        return Apn::with('country')->find($country_id);
    }

    public function store(CreateApnRequest $request)
    {
        $apn = Apn::create([
            'country_id' => $request->get('country_id'),
            'operator' => $request->get('operator'),
            'apn' => $request->get('apn'),
        ]);

        return $apn;
    }

    public function edit($country_id)
    {
        return Apn::with('country')->find($country_id);
    }

    public function update($apn_id, CreateApnRequest $request)
    {
        $apn = Apn::find($apn_id);

        $apn->country_id = $request->get('country_id');
        $apn->operator = $request->get('operator');
        $apn->apn = $request->get('apn');
        $apn->save();

        return $apn;
    }
}
