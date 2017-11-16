<?php

namespace Fieldtrip\Http\Controllers;

use Fieldtrip\Http\Requests\UpdateHours;
use Fieldtrip\Mail\TripResponse;
use Fieldtrip\Trip;
use Illuminate\Http\Request;
use Fieldtrip\Mail\TripOffer;
use Fieldtrip\Http\Requests\StoreResponse;
use function Fieldtrip\Services\serialDecode;

class DriverEmail extends Controller
{

    protected $trip;

    public function __construct(Trip $trip)
    {

        $this->middleware('auth')->except('response', 'storeResponse');

        $this->trip = $trip;

    }


    public function sendOffer(Trip $trip)
    {

        foreach($trip->user as $user) {
            \Mail::to($user)
                ->send(new TripOffer($trip, $user));
        }

        return redirect()->route('list_trips')->with('flash_message', 'The trip details have been sent to the drivers.');

    }


    public function response($serial)
    {
        return view('trips.response')
            ->withTrip($this->trip->singleTripUser(serialDecode($serial)));
    }

    public function storeResponse($id, StoreResponse $storeResponse)
    {

        $data = $storeResponse->persist($id);

        $trip = $this->trip->singleTripUser($data);
        $user = $trip->user->first();

        if($storeResponse->get('response') == 'declined') {
            \Mail::to($user)
                ->cc(config('app.coordinator'))
                ->send(new TripResponse($trip, $user));
        } else {
            \Mail::to($user)
                ->send(new TripResponse($trip, $user));
        }



        return back()->with('flash_message', 'You response has been saved, you should receive an email shortly.');

    }


    public function submitHours($serial)
    {

        $data = serialDecode($serial);

        if(Auth()->id() == $data['1'] OR Auth()->user()->can('update', Trip::class))
        {
            return view('trips.hours')
                ->withTrip($this->trip->singleTripUser($data));
        }

        return redirect('home')->withErrors( 'You can only update hours for your own trips.');


    }

    public function storeHours($id, UpdateHours $updateHours)
    {

        $updateHours->persist($id);

        return back()->with('flash_message', 'Your hours have been recorded');

    }


}
