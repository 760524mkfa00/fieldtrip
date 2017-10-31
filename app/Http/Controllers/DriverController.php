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


    public function storeTripHours($id)
    {
        return request();
    }


}
