@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Drivers
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="table">
                                    <thead>
                                    <th>Zone</th>
                                    <th>Route</th>
                                    <th>End AM</th>
                                    <th>End Point AM</th>
                                    <th>Start PM</th>
                                    <th>Start Point PM</th>
                                    <th>End PM</th>
                                    <th>Name</th>
                                    <th>Other Job</th>
                                    <th>Notes</th>
                                    <th>Accepted</th>
                                    <th>Declined</th>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    @foreach($drivers as $driver)
                                        <tr>
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
                            </div>
                        </div>
                        <a title="assign" href="{!! URL::route('list_trips') !!}" class="btn btn-primary">Back to Trips </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection