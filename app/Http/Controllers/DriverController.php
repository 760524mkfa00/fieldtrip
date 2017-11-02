<?php

namespace Fieldtrip\Http\Controllers;

use Fieldtrip\Http\Requests\UpdateDriverHours;
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


    public function storeTripHours($id, UpdateDriverHours $request)
    {
        \DB::table('trip_user')
            ->where('id', $id)
            ->update($request->except('_token', 'button'));

        return \Response::json(['success' => true, 'message' => 'Information Updated!']);
    }


}
