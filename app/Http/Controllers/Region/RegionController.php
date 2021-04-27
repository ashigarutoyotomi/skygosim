<?php


namespace App\Http\Controllers\Region;


use App\Http\Controllers\Controller;
use App\Http\Requests\Region\CreateRegionRequest;
use App\Models\Region\Region;

class RegionController extends Controller
{
    public function all()
    {
        return Region::all();
    }

    public function index()
    {
        return Region::paginate(20);
    }

    public function show($region_id)
    {
        return Region::find($region_id);
    }

    public function store(CreateRegionRequest $request)
    {
        $region = Region::create([
            'name' => $request->get('name'),
            'tag' => $request->get('tag'),
        ]);

        return $region;
    }

    public function edit($region_id)
    {
        return Region::find($region_id);
    }

    public function update($region_id, CreateRegionRequest $request)
    {
        $region = Region::find($region_id);

        $region->name = $request->get('name');
        $region->tag = $request->get('tag');
        $region->save();

        return $region;
    }
}
