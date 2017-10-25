@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <-left right->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Trips
{{--                        @can('create', Fieldtrip\Trip::class)--}}
                            <a class="pull-right btn btn-sm btn-primary" href="{{ route('create_trip') }}">New</a>
                        {{--@endcan--}}
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="table">
                                    <thead>
                                        <th>#</th>
                                        <th></th>
                                        <th>Pick Up Time</th>
                                        <th>Pick Up Location</th>
                                        <th>Drop Off Time</th>
                                        <th>Drop Off Location</th>
                                        <th>Students</th>

                                        <tr>
                                            <td></td>
                                            <td class="small"><strong>Name</strong></td>
                                            <td class="small"><strong>Unit</strong></td>
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
                                                <td colspan="8" style="background-color: azure; font-size: 1.5em; font-weight: bolder;">{!! $key !!}</td>
                                            </tr>
                                            @foreach($tripDate as $trip)
                                                </tr>
                                                    <td><strong>
                                                        <a href="{{ route('edit_trip', $trip->id) }}" class="" style="color: red;">
                                                            {!! $trip->field_trip_number !!}
                                                        </a>
                                                    </strong></td>
                                                    <td><a title="Assign Driver"
                                                           href="{!! URL::route('assign_driver', $trip->id) !!}"
                                                           class="" style="color:blue;"><i class="fa fa-plus"></i>
                                                        </a></td>
                                                    <td><strong>{!! $trip->pickup_time !!}</strong></td>
                                                    <td><strong>{!! $trip->pickup_location !!}</strong></td>
                                                    <td><strong>{!! $trip->dropoff_time !!}</strong></td>
                                                    <td><strong>{!! $trip->dropoff_location !!}</strong></td>
                                                    <td><strong>{!! $trip->student_count !!}</strong></td>
                                            {{--TODO: Check user can remove trip--}}
                                                    <td>
                                                        <a title="Remove"
                                                           href="{!! URL::route('remove_trip', $trip->id) !!}"
                                                           class="pull-right" style="color:red;"><i class="fa fa-times"></i>
                                                        </a>
                                                    </td>

                                                </tr>
                                                @foreach($trip->user as $user)
                                                    <tr style="color: blue;">
                                                        <td>{!! $user->first_name . ' ' . $user->last_name !!}</td>
                                                        <td>{!! $user->pivot->unit !!}</td>
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