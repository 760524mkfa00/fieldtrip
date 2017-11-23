@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Trip
                    </div>

                    <div class="card-body">
                        <div id="errors"></div>
                        @include('trips/_partials/responses')
                        @if($trip->user->first()->pivot->response == 'declined')
                            <h4>You declined this trip, you cannot add hours. Talk to your coordinator.</h4>
                        @elseif($trip->user->first()->pivot->hours_submitted == '1')
                            <h4>You have already submitted hours for this trip.</h4>
                            <p>Please contact your coordinator to make changes.</p>
                        @else
                            <p>Please check all details are correct before submitting hours.</p>
                            <p>Leave unused boxes with number: 0</p>
                            <form role="form" method="POST" action="{{ route('submit_hours', $trip->user->first()->pivot->id) }}">
                                {{ csrf_field() }}
                                {{--<input type="hidden" name="trip_id" value="{{ $trip->id }}">--}}
                                <input type="hidden" name="user_id" value="{{ $trip->user->first()->id }}">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Straight</div>
                                                <input id="one" type="text" class="form-control" name="one" value="{!! $trip->user->first()->pivot->one !!}" required autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Over Time</div>
                                                <input id="oneHalf" type="text" class="form-control" name="oneHalf" value="{!! $trip->user->first()->pivot->oneHalf !!}" required autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Double Over Time</div>
                                                <input id="two" type="text" class="form-control" name="two" value="{!! $trip->user->first()->pivot->two !!}" required autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">KM</div>
                                                <input id="mileage" type="text" class="form-control" name="mileage" value="{!! $trip->user->first()->pivot->mileage !!}" required autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Bank</div>
                                                <select id='bank' class="form-control" name="bank">
                                                    <option value="no" {!! $trip->user->first()->pivot->bank == 'no' ? 'selected="selected"' : ''  !!}>No</option>
                                                    <option value="yes" {!! $trip->user->first()->pivot->bank == 'yes' ? 'selected="selected"' : ''  !!}>Yes</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Note</div>
                                                <textarea id="note" type="text" class="form-control" name="note" value="{!! $trip->user->first()->pivot->note !!}" autofocus></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" name="button" class="btn btn-primary" value="{!! $trip->user->first()->pivot->id !!}">Submit Hours</button>
                                        <a href="{!! URL::to('home') !!}" class="btn btn-primary">Back to my Trips</a>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
