@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">My Trips</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed" id="table">
                            <thead>
                                <th>#</th>
                                <th>Date</th>
                                <th width="7%">Pick Up Time</th>
                                <th>Pick Up Location</th>
                                <th width="7%">Return Time</th>
                                <th>Return Pick up Location</th>
                                <th>1</th>
                                <th>1.5</th>
                                <th>2</th>
                                <th>Bank</th>
                            </thead>
                            <tbody>
                                @foreach($user->trip as $trip)
                                    <tr>
                                        <td>{!! $trip->field_trip_number !!}</td>
                                        <td>{!! $trip->trip_date->format('M d, Y') !!}</td>
                                        <td>{!! $trip->pickup_time !!}</td>
                                        <td>{!! $trip->pickup_location !!}</td>
                                        <td>{!! $trip->dropoff_time !!}</td>
                                        <td>{!! $trip->dropoff_location !!}</td>
                                        <td>{!! $trip->pivot->one !!}</td>
                                        <td>{!! $trip->pivot->oneHalf !!}</td>
                                        <td>{!! $trip->pivot->two !!}</td>
                                        <td>{!! $trip->pivot->bank !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Totals</strong></td>
                                    <td>{!! $user->oneTotal !!}</td>
                                    <td>{!! $user->oneHalfTotal !!}</td>
                                    <td>{!! $user->twoTotal !!}</td>
                                    <td></td>
                                </tr>
                            </tfooter>
                        </table>
                        <p class="small">Legend: (1 - Straight Time, 1.5 - Overtime, 2 - Double Time)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
