@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Trips for week ???
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Pick Up Time</th>
                                        <th>Pick Up Location</th>
                                        <th>Drop Off Time</th>
                                        <th>Drop Off Location</th>
                                        <th>Students</th>
                                        <tr>
                                            <td class="small"><strong>Name</strong></td>
                                            <td class="small"><strong>Accepted</strong></td>
                                            <td class="small"><strong>Decline</strong></td>
                                            <td class="small"><strong>Hours</strong></td>
                                            <td class="small"><strong>Miles</strong></td>
                                            <td class="small"><strong>Bank</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($trips as $key => $tripDate)
                                            <tr>
                                                <td colspan="6" style="background-color: azure; font-size: 1.5em; font-weight: bolder;">{!! $key !!}</td>
                                            </tr>
                                            @foreach($tripDate as $trip)
                                                </tr>
                                                    <td style="color: red;"><strong>{!! $trip->field_trip_number !!}</strong></td>
                                                    <td><strong>{!! $trip->pickup_time !!}</strong></td>
                                                    <td><strong>{!! $trip->pickup_location !!}</strong></td>
                                                    <td><strong>{!! $trip->dropoff_time !!}</strong></td>
                                                    <td><strong>{!! $trip->dropoff_location !!}</strong></td>
                                                    <td><strong>{!! $trip->student_count !!}</strong></td>
                                                </tr>
                                                @foreach($trip->user as $user)
                                                    <tr style="color: blue;">
                                                        <td>{!! $user->first_name . ' ' . $user->last_name !!}</td>
                                                        <td>{!! $user->pivot->accepted_hours !!}</td>
                                                        <td>{!! $user->pivot->declined_hours !!}</td>
                                                        <td>{!! $user->pivot->hours !!}</td>
                                                        <td>{!! $user->pivot->mileage !!}</td>
                                                        <td>{!! $user->pivot->bank !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection