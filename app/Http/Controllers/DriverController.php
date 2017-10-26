<?php

namespace Fieldtrip\Http\Controllers;

use Fieldtrip\Trip;
use Fieldtrip\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{


    public function assign(Trip $trip)
    {

        // TODO: Get a list of drivers by zone and hours

        $totals = User::with('trip', 'route', 'route.zone')->get();

        foreach($totals as $total) {
            $total->accepted = $total->trip->sum('pivot.accepted_hours');
            $total->declined = $total->trip->sum('pivot.declined_hours');
            $total->totalHours = $total->accepted + $total->declined;
            $total->zone = $total->route->zone->zone;
        }

        $totals->sortBy('zone')->sortBy( 'totalHours')->values()->all();

        return view('drivers.assign', compact('totals'));

    }
}
