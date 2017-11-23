@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">My Trips</div>

                <div class="card-body">
                    <table class="table table-responsive-xl" id="table">
                        <caption>Legend: (1 - Straight Time, 1.5 - Overtime, 2 - Double Time)</caption>
                        <thead class="thead-dark">
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Pick Up Time</th>
                            <th scope="col">Pick Up Location</th>
                            <th scope="col">Return Time</th>
                            <th scope="col">Return Pick up Location</th>
                            <th scope="col">1</th>
                            <th scope="col">1.5</th>
                            <th scope="col">2</th>
                            <th scope="col">Bank</th>
                        </thead>
                        <tbody>
                            @foreach($user->trip as $trip)
                                <tr>
                                    <td scope="row">{!! $trip->field_trip_number !!}</td>
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
                    {{--<p class="small">Legend: (1 - Straight Time, 1.5 - Overtime, 2 - Double Time)</p>--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
