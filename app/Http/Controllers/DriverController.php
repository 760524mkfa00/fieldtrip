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

        $totals = User::with('trip')->get();

//        foreach($totals as $total) {
//
////            $total->accepted = $total->reduce($trip->pivot, function($items) {
////                return $items->accepted_hours;
////            });
//
//        }

        dd($totals);

        return view('drivers.assign', compact('trip'));

    }
}
