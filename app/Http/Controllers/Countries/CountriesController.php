<?php


namespace App\Http\Controllers\Countries;


use App\Http\Controllers\Controller;
use App\Http\Requests\Countries\CreateCountryRequest;
use App\Models\Countries\Country;

class CountriesController extends Controller
{
    public function all()
    {
        return Country::all();
    }

    public function index()
    {
        return Country::with('region')->paginate(20);
    }

    public function show($country_id)
    {
        return Country::with('region')->find($country_id);
    }

    public function store(CreateCountryRequest $request)
    {
        $country = Country::create([
            'region_id' => $request->get('region_id'),
            'name' => $request->get('name'),
            'tag' => $request->get('tag'),
        ]);

        return $country;
    }

    public function edit($country_id)
    {
        return Country::with('region')->find($country_id);
    }

    public function update($country_id, CreateCountryRequest $request)
    {
        $country = Country::find($country_id);

        $country->region_id = $request->get('region_id');
        $country->name = $request->get('name');
        $country->tag = $request->get('tag');
        $country->save();

        return $country;
    }
}
