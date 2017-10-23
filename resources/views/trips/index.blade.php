@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
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
                                    </thead>
                                    <tbody>
                                        @foreach($trips as $key => $tripDate)
                                            <tr>
                                                <td colspan="6">{!! $key !!}</td>
                                            </tr>
                                            @foreach($tripDate as $trip)
                                                </tr>
                                                    <td>{!! $trip->field_trip_number !!}</td>
{{--                                                    <td>{!! $trip->trip_date->toFormattedDateString() !!}</td>--}}
                                                    <td>{!! $trip->pickup_time !!}</td>
                                                    <td>{!! $trip->pickup_location !!}</td>
                                                    <td>{!! $trip->dropoff_time !!}</td>
                                                    <td>{!! $trip->dropoff_location !!}</td>
                                                    <td>{!! $trip->student_count !!}</td>
                                                    <td class="hidden-xs" style="width:2%;">
                                                        {{--<a title="Edit"--}}
                                                           {{--href="{!! URL::route('fieldtrips.edit', $trip->id) !!}"--}}
                                                           {{--class="pull-right"><i class="fa fa-pencil-square-o fa"></i>--}}
                                                            {{--<a>--}}
                                                    </td>
                                                </tr>
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