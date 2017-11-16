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
