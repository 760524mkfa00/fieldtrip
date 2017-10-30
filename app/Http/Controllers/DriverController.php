<?php

namespace Fieldtrip\Http\Controllers;

use function Fieldtrip\Services\sortData;
use Fieldtrip\Trip;
use Fieldtrip\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{


    public function assign(Trip $trip)
    {

//        $totals = User::with('trip', 'route', 'route.zone')
//            ->get();
//
//        foreach($totals as $total) {
//            $total->accepted = $total->trip->sum('pivot.accepted_hours');
//            $total->declined = $total->trip->sum('pivot.declined_hours');
//            $total->totalHours = $total->accepted + $total->declined;
//            $total->zone = $total->route->zone->zone;
//        }
//
//        $drivers = sortData($totals->toArray(), ['zone' => 'asc', 'totalHours' => 'asc', 'declined' => 'asc']);

        $drivers = User::sortedUser();

        return view('drivers.assign')
            ->withDrivers($drivers)
            ->withTrip($trip);

    }

    public function assignToTrip(Trip $trip, User $user)
    {

        $trip->user()->toggle($user->id);

        return back();

    }


}
