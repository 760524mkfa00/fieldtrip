@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Drivers (Last payroll adjustment date: {!! $lastAdjustment !!})
                        <div class="float-right small"><a title="assign" href="{!! URL::route('list_trips') !!}" class="btn btn-primary btn-sm">Back to Trips </a></div>
                    </div>
                    <div class="card-body">
                                {{--can see this info--}}
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col"><strong>Trip #</strong>{!! $trip->field_trip_number !!}</div>
                                <div class="col"><strong>Pick up:</strong> {!! $trip->pickup_location . ' - ' . $trip->pickup_time !!}</div>
                                <div class="col"><strong>Drop off:</strong> {!! $trip->dropoff_location . ' - ' . $trip->dropoff_time !!}</div>
                                <div class="col"><strong>Notes:</strong> {!! $trip->fieldtrip_notes !!}</div>
                            </div>
                        </div>
                        <p></p>
                        <table class="table table-responsive-xl" id="table">
                            <thead class="thead-dark">
                                <th scope="col">Zone</th>
                                <th scope="col">Route</th>
                                <th scope="col">End AM</th>
                                <th scope="col">End Point AM</th>
                                <th scope="col">Start PM</th>
                                <th scope="col">Start Point PM</th>
                                <th scope="col">End PM</th>
                                <th scope="col">Name</th>
                                <th scope="col">Other Job</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Accepted</th>
                                <th scope="col">Declined</th>
                                <th scope="col">Total</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                            @foreach($drivers as $driver)
                                <tr style="background-color: {!! $driver['color'] !!};">
                                    <td>{!! $driver['zone'] !!}</td>
                                    <td>{!! $driver['route']['route_number'] !!}</td>
                                    <td>{!! $driver['route']['end_time_am'] !!}</td>
                                    <td>{!! $driver['route']['end_point_am'] !!}</td>
                                    <td>{!! $driver['route']['start_time_pm'] !!}</td>
                                    <td>{!! $driver['route']['start_point_pm'] !!}</td>
                                    <td>{!! $driver['route']['end_time_pm'] !!}</td>
                                    <td><strong>{!! $driver['first_name'] . ' ' . $driver['last_name'] !!}</strong></td>
                                    <td>{!! $driver['other_job_posted'] !!}</td>
                                    <td>{!! $driver['driver_notes'] !!}</td>
                                    <td>{!! $driver['accepted'] !!}</td>
                                    <td>{!! $driver['declined'] !!}</td>
                                    <td><strong>{!! $driver['totalHours'] !!}</strong></td>
                                    <td>
                                        <a title="assign"
                                           href="{!! URL::route('assign_trip', [$trip->id, $driver['id']]) !!}"
                                           class="pull-right">Assign
                                        </a>
                                    </td>
                                    <td>
                                        @if($trip->user->contains($driver['id']))
                                            <span class="" style="color: green;"><i class="fa fa-check"></i></span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    <div class="col">
                        <a title="assign" href="{!! URL::route('list_trips') !!}" class="btn btn-primary">Back to Trips </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection