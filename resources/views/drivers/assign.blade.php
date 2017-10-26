@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
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
                                    <th>Name</th>
                                    <th>Route</th>
                                    <th>End Point AM</th>
                                    <th>Start Point PM</th>
                                    <th>Accepted</th>
                                    <th>Declined</th>
                                    <th>Total</th>
                                    </thead>
                                    <tbody>
                                    @foreach($totals as $driver)
                                        <tr>
                                            <td>{!! $driver->zone !!}</td>
                                            <td>{!! $driver->first_name . ' ' . $driver->last_name !!}</td>
                                            <td>{!! $driver->route->route_number !!}</td>
                                            <td>{!! $driver->route->end_point_am !!}</td>
                                            <td>{!! $driver->route->start_point_pm !!}</td>
                                            <td>{!! $driver->accepted !!}</td>
                                            <td>{!! $driver->declined !!}</td>
                                            <td>{!! $driver->totalHours !!}</td>
                                        </tr>
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