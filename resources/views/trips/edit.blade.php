@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-md-4">
                <div class="card">
                    <div class="card-header">Update Trip</div>

                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('update_trip', $trip->id) }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('field_trip_number') ? ' has-error' : '' }}">
                                <label for="field_trip_number">Field Trip Number</label>

                                    <input id="field_trip_number" type="text" class="form-control" name="field_trip_number" value="{{ $trip->field_trip_number }}" required autofocus>
                                    @if ($errors->has('field_trip_number'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('field_trip_number') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('trip_date') ? ' has-error' : '' }}">
                                <label for="trip_date">Trip Date</label>

                                    <input id="trip_date" type="text" class="form-control" name="trip_date" value="{{ $trip->trip_date }}" required autofocus>
                                    @if ($errors->has('trip_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('trip_date') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('pickup_time') ? ' has-error' : '' }}">
                                <label for="pickup_time">Pickup Time</label>

                                    <input id="pickup_time" type="text" class="form-control" name="pickup_time" value="{{ $trip->pickup_time }}" required autofocus>
                                    @if ($errors->has('pickup_time'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('pickup_time') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('pickup_location') ? ' has-error' : '' }}">
                                <label for="pickup_location">Pickup Location</label>

                                    <input id="pickup_location" type="text" class="form-control" name="pickup_location" value="{{ $trip->pickup_location }}" required autofocus>
                                    @if ($errors->has('pickup_location'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('pickup_location') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('dropoff_time') ? ' has-error' : '' }}">
                                <label for="dropoff_time">Dropoff Time</label>

                                    <input id="dropoff_time" type="text" class="form-control" name="dropoff_time" value="{{ $trip->dropoff_time }}" autofocus>
                                    @if ($errors->has('dropoff_time'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('dropoff_time') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('dropoff_location') ? ' has-error' : '' }}">
                                <label for="dropoff_location">Dropoff Location</label>

                                    <input id="dropoff_location" type="text" class="form-control" name="dropoff_location" value="{{ $trip->dropoff_location }}" autofocus>
                                    @if ($errors->has('dropoff_location'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('dropoff_location') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('hours') ? ' has-error' : '' }}">
                                <label for="hours">Hours</label>

                                    <input id="hours" type="text" class="form-control" name="hours" value="{{ $trip->hours }}" required autofocus>
                                    @if ($errors->has('hours'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('hours') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('student_count') ? ' has-error' : '' }}">
                                <label for="student_count">Student Count</label>

                                    <input id="student_count" type="text" class="form-control" name="student_count" value="{{ $trip->student_count }}" required autofocus>
                                    @if ($errors->has('student_count'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('student_count') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('fieldtrip_notes') ? ' has-error' : '' }}">
                                <label for="fieldtrip_notes">Field Trip Notes</label>

                                    <input id="fieldtrip_notes" type="text" class="form-control" name="fieldtrip_notes" value="{{ $trip->fieldtrip_notes }}" autofocus>
                                    @if ($errors->has('fieldtrip_notes'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fieldtrip_notes') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                            <a href="{{ route('list_trips') }}" class="btn btn-primary">
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection