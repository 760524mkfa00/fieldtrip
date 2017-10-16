<?php

namespace Fieldtrip\Http\Controllers;


use Fieldtrip\Zone;
use Fieldtrip\Http\Requests\StoreZone as StoreZoneRequest;
use Fieldtrip\Http\Requests\UpdateZone as UpdateZoneRequest;
use Illuminate\Http\Request;

class ZoneController extends Controller
{


    public function index()
    {

        return view('zones.index')
            ->withZones(Zone::all());
    }

    public function create()
    {
        return view('zones.create');
    }

    public function store(StoreZoneRequest $request)
    {
        $data = $request->only('zone');

        $zone = Zone::create($data);
        return \Redirect::route('list_zones')->with('flash_message', 'Zone has been created.');

    }

    public function edit(Zone $zone)
    {
        return view('zones.edit', compact('zone'));
    }


    public function update(Zone $zone, UpdateZoneRequest $request)
    {
        $data = $request->only('zone');
        $zone->fill($data)->save();
        return \Redirect::route('list_zones')->with('flash_message', 'Zone has been updated.');
    }

    public function destroy(Zone $zone)
    {

        try {
            $zone->delete();
        }
        catch(\Exception $e)
        {
            return \Redirect::back()->withErrors('You cannot delete this item, it may has information attached to it. Please remove that information first');
        }

        return \Redirect::route('list_zones')->with('flash_message', 'Zone has been removed.');

    }

}
