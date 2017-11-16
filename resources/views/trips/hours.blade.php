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
                                @include('trips/_partials/responses')
                                @if(! $trip->user->first()->pivot->response == 'accepted')
                                    <h4>You declined this trip, you cannot add hours. Talk to your coordinator.</h4>
                                @elseif($trip->user->first()->pivot->hours_submitted == '1')
                                    <h4>You have already submitted hours for this trip.</h4>
                                    <p>Please contact your coordinator to make changes.</p>
                                @else
                                    <p>Please check all details are correct before submitting hours.</p>
                                    <p>Leave unused boxes with number: 0</p>
                                    <form class="form-inline" role="form" method="POST" action="{{ route('submit_hours', $trip->user->first()->pivot->id) }}">
                                        {{ csrf_field() }}
                                        {{--<input type="hidden" name="trip_id" value="{{ $trip->id }}">--}}
                                        <input type="hidden" name="user_id" value="{{ $trip->user->first()->id }}">
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-addon">Straight</div>
                                                <input id="one" type="text" class="form-control" name="one" value="{!! $trip->user->first()->pivot->one !!}" required autofocus>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-addon">Over Time</div>
                                                <input id="oneHalf" type="text" class="form-control" name="oneHalf" value="{!! $trip->user->first()->pivot->oneHalf !!}" required autofocus>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-addon">Double Over Time</div>
                                                <input id="two" type="text" class="form-control" name="two" value="{!! $trip->user->first()->pivot->two !!}" required autofocus>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-addon">KM</div>
                                                <input id="mileage" type="text" class="form-control" name="mileage" value="{!! $trip->user->first()->pivot->mileage !!}" required autofocus>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-addon">Bank</div>
                                                <select id='bank' class="form-control" name="bank">
                                                    <option value="no" {!! $trip->user->first()->pivot->bank == 'no' ? 'selected="selected"' : ''  !!}>No</option>
                                                    <option value="yes" {!! $trip->user->first()->pivot->bank == 'yes' ? 'selected="selected"' : ''  !!}>Yes</option>
                                                </select>
                                            </div>
                                        </td>
                                        <button type="submit" name="button" class="btn btn-primary" value="{!! $trip->user->first()->pivot->id !!}">Submit Hours</button>
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
