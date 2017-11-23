<?php

namespace Fieldtrip\Http\Controllers;

use Fieldtrip\Adjustment;
use Fieldtrip\Http\Requests\UpdateDriverHours;
use Fieldtrip\Mail\TripOffer;
use Fieldtrip\Trip;
use Fieldtrip\User;
use Illuminate\Http\Request;

/**
 * Class DriverController
 * @package Fieldtrip\Http\Controllers
 */
class DriverController extends Controller
{

    protected $user;

    protected $trip;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Trip $trip)
    {
        $this->middleware('auth');

        $this->user = $user;

        $this->trip = $trip;
    }

    /**
     * @param Trip $trip
     * @return mixed
     */
    public function assign(Trip $trip)
    {
        return view('drivers.assign')
            ->withDrivers($this->user->sortedUser())
            ->withTrip($trip)
            ->withLastAdjustment(Adjustment::LastAdjustmentDate());
    }

    public function status()
    {
        return view('drivers.status')
            ->withDrivers($this->user->sortedUser())
            ->withLastAdjustment(Adjustment::LastAdjustmentDate());
    }

    /**
     * @param Trip $trip
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignToTrip(Trip $trip, User $user)
    {

        if($trip->user->contains($user->id))
        {
            $trip->user()->detach($user);
        } else {
            $trip->user()->attach($user, ['accepted_hours' => $trip->hours]);
        }

        return back();

    }


    /**
     * @param $id
     * @param UpdateDriverHours $request
     * @return mixed
     */
    public function storeTripHours($id, UpdateDriverHours $request)
    {

        $this->trip->storeUserTrip($id, $request->except('_token', 'button'));

        return \Response::json(['success' => true, 'message' => 'Information Updated!']);

    }


    public function currentOvertimeAdjustment($date)
    {
        return view('drivers.status')
            ->withDrivers($this->user->sortedUser($date))
            ->withLastAdjustment($date ?? Adjustment::LastAdjustmentDate());
    }



}
