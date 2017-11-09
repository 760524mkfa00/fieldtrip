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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('auth');

        $this->user = $user;
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


    public function mailable(Trip $trip)
    {

        foreach($trip->user as $user) {
            \Mail::to($user)->send(new TripOffer($trip, $user));
        }

        return redirect()->route('list_trips')->with('flash_message', 'The trip details have been sent to the drivers.');

    }


}
