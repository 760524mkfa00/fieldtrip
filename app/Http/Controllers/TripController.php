<?php

namespace Fieldtrip\Http\Controllers;

use Carbon\Carbon;
use Fieldtrip\Mail\TripResponse;
use Fieldtrip\Trip;
use Illuminate\Http\Request;
use Fieldtrip\Rules\Contains;

class TripController extends Controller
{

    protected $trip;

    public function __construct(Trip $trip)
    {

        $this->middleware('auth')->except('response', 'storeResponse');

        $this->trip = $trip;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!$filter = \Request::all())
        {
            if (\Session::exists('dateRange')) {
                $dateRange = \Session::get('dateRange');
                $filter['start_range'] = $dateRange['start_range'];
                $filter['end_range'] = $dateRange['end_range'];
                $filter['selectedOption'] = $dateRange['selectedOption'];
            } else {
                $filter['start_range'] = date("Y-m-d");
                $filter['end_range'] = date("Y-m-d");
                $filter['selectedOption'] = 'Today';
            }

        }
        \Session::put('dateRange', $filter);

        $tripDate = $this->trip->tripFilter($filter);

        return view('trips.index')
            ->withTrips($tripDate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->only('field_trip_number', 'trip_date', 'pickup_time', 'pickup_location', 'dropoff_time', 'dropoff_location', 'student_count', 'fieldtrip_notes');


        $this->trip->create($data);

        return redirect()->route('list_trips')->with('flash_message', 'Trip has been created.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        return view('trips.edit', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {

        $data = $request->only('field_trip_number', 'trip_date', 'pickup_time', 'pickup_location', 'dropoff_time', 'dropoff_location', 'student_count', 'fieldtrip_notes');
        $trip->fill($data)->save();
        return \Redirect::route('list_trips')->with('flash_message', 'Trip has been updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        try {
            $trip->delete();
        }
        catch(\Exception $e)
        {
            return \Redirect::back()->withErrors('You cannot delete this item, it may has information attached to it. Please remove that information first');
        }

        return \Redirect::route('list_trips')->with('flash_message', 'Trip has been removed.');

    }

    public function response($serial)
    {
        $data  = base64_decode(strtr($serial, '._-', '+/='));
        $data  = unserialize($data);

        $trip = $this->trip->singleTripUser($data['1'],$data['0']);

        return view('trips.response')
            ->withTrip($trip);
    }

    public function storeResponse($id, Request $request)
    {

        $request->validate([
            'response' => ['required', new Contains]
        ]);

        $data = $request->only('response');
        $data['response_time'] = Carbon::now()->format('Y-m-d H:i:s');

        \DB::table('trip_user')
            ->where('id', $id)
            ->update($data);

        $trip = $this->trip->singleTripUser($request->get('user_id'), $request->get('trip_id'));


        \Mail::to($trip->user->first())->send(new TripResponse($trip));

        return back()->with('flash_message', 'You response has been saved, you should receive an email shortly.');

    }


//    public function TripUser($userID, $tripID)
//    {
//        return $this->trip->with(['user' => function($query) use($userID) {
//            $query->where('user_id', '=', $userID)->limit(1);
//        }])->where('id', $tripID)->first();
//
//    }


}
