<?php

namespace Fieldtrip\Http\Controllers;

use Fieldtrip\Http\Requests\UpdateDriverHours;
use Fieldtrip\Trip;
use Fieldtrip\User;
use Illuminate\Http\Request;

/**
 * Class DriverController
 * @package Fieldtrip\Http\Controllers
 */
class DriverController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Trip $trip
     * @return mixed
     */
    public function assign(Trip $trip)
    {

        $drivers = User::sortedUser();

        return view('drivers.assign')
            ->withDrivers($drivers)
            ->withTrip($trip);

    }

    /**
     * @param Trip $trip
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignToTrip(Trip $trip, User $user)
    {

        $trip->user()->toggle($user->id);

        return back();

    }


    /**
     * @param $id
     * @param UpdateDriverHours $request
     * @return mixed
     */
    public function storeTripHours($id, UpdateDriverHours $request)
    {
        \DB::table('trip_user')
            ->where('id', $id)
            ->update($request->except('_token', 'button'));

        return \Response::json(['success' => true, 'message' => 'Information Updated!']);
    }


}
