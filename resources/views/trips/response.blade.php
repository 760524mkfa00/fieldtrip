@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Trip
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="errors"></div>

                                <table class="table table-condensed" id="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Pick Up Time</th>
                                        <th>Pick Up Location</th>
                                        <th>Return Time</th>
                                        <th>Return Location</th>
                                        <th>Students</th>
                                        <th>Note</th>

                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>{!! $trip->field_trip_number !!} </strong></td>
                                            <td><strong>{!! $trip->pickup_time !!}</strong></td>
                                            <td><strong>{!! $trip->pickup_location !!}</strong></td>
                                            <td><strong>{!! $trip->dropoff_time !!}</strong></td>
                                            <td><strong>{!! $trip->dropoff_location !!}</strong></td>
                                            <td><strong>{!! $trip->student_count !!}</strong></td>
                                            <td style="color: red;"><strong>{!! $trip->fieldtrip_notes !!}x</strong></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="small"><strong>Name</strong></td>
                                            <td class="small"><strong>Unit</strong></td>
                                            {{--<td class="small"><strong>Hours</strong></td>--}}
                                            <td colspan="4" class="small"><strong>Notes</strong></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>{!! $trip->user->first()->first_name . ' ' . $trip->user->first()->last_name !!}</td>
                                            <td>{!! $trip->user->first()->pivot->unit ?? $trip->user->first()->route->unit ?? 'none' !!}</td>
{{--                                            <td>{!! ($trip->user->first()->pivot->accepted_hours > 0) ?: $trip->user->first()->pivot->declined_hours !!}</td>--}}
                                            <td colspan="4">{!! $trip->user->first()->pivot->note !!}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @if( !empty($trip->user->first()->pivot->response))
                                    <h3>You {{ $trip->user->first()->pivot->response }} this trip at {{ $trip->user->first()->pivot->response_time }}.</h3>
                                    <p>Please contact your coordinator if things have changed.</p>
                                @else
                                    <p>Please check all details are correct before accepting or declining this trip.</p>
                                    <form class="form-inline" role="form" method="POST" action="{{ route('store_response', $trip->user->first()->pivot->id) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                                        <input type="hidden" name="user_id" value="{{ $trip->user->first()->id }}">
                                        <select id='response' class="form-control form-control-sm" name="response">
                                            <option value="">Please select an options</option>
                                            <option value="accepted">Accept</option>
                                            <option value="declined">Decline</option>
                                        </select>
                                        <button type="submit" name="button" class="btn btn-primary" value="{!! $trip->user->first()->pivot->id !!}">Respond</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
