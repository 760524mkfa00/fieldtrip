<div class="form-group{{ $errors->has('route_number') ? ' has-error' : '' }}">
    <label for="route_number" class="col-md-4 control-label">Route Number</label>

    <div class="col-md-6">
        <input id="route_number" type="text" class="form-control" name="route_number"
               value="{{ old('route_number', $route->route_number ?? null) }}" required autofocus>

        @if ($errors->has('route_number'))
            <span class="help-block">
                                        <strong>{{ $errors->first('route_number') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('zone_id') ? ' has-error' : '' }}">
    <label for="zone_id" class="col-md-4 control-label">Zone</label>

    <div class="col-md-6">

        <select name="zone_id" id="zone_id" class="form-control">
            <option value="">Select Zone...</option>
            @foreach($zones as $zone)
                <option value="{{ $zone->id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>
                    {{ $zone->zone }}
                </option>
            @endforeach
        </select>

        @if ($errors->has('zone_id'))
            <span class="help-block">
                                        <strong>{{ $errors->first('zone_id') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('end_time_am') ? ' has-error' : '' }}">
    <label for="end_time_am" class="col-md-4 control-label">End Time AM</label>

    <div class="col-md-6">
        <input id="end_time_am" type="text" class="form-control" name="end_time_am"
               value="{{ old('end_time_am', $route->end_time_am ?? null) }}" required autofocus>

        @if ($errors->has('end_time_am'))
            <span class="help-block">
                                        <strong>{{ $errors->first('end_time_am') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('end_point_am') ? ' has-error' : '' }}">
    <label for="end_point_am" class="col-md-4 control-label">End Point AM</label>

    <div class="col-md-6">
        <input id="end_point_am" type="text" class="form-control" name="end_point_am"
               value="{{ old('end_point_am', $route->end_point_am ?? null) }}" required autofocus>

        @if ($errors->has('end_point_am'))
            <span class="help-block">
                                        <strong>{{ $errors->first('end_point_am') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('start_time_pm') ? ' has-error' : '' }}">
    <label for="start_time_pm" class="col-md-4 control-label">Start Time PM</label>

    <div class="col-md-6">
        <input id="start_time_pm" type="text" class="form-control" name="start_time_pm"
               value="{{ old('start_time_pm', $route->start_time_pm ?? null) }}" required autofocus>

        @if ($errors->has('start_time_pm'))
            <span class="help-block">
                                        <strong>{{ $errors->first('start_time_pm') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('start_point_pm') ? ' has-error' : '' }}">
    <label for="start_point_pm" class="col-md-4 control-label">Start Point PM</label>

    <div class="col-md-6">
        <input id="start_point_pm" type="text" class="form-control" name="start_point_pm"
               value="{{ old('start_point_pm', $route->start_point_pm ?? null) }}" required autofocus>

        @if ($errors->has('start_point_pm'))
            <span class="help-block">
                                        <strong>{{ $errors->first('start_point_pm') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('end_time_pm') ? ' has-error' : '' }}">
    <label for="end_time_pm" class="col-md-4 control-label">End Time PM</label>

    <div class="col-md-6">
        <input id="end_time_pm" type="text" class="form-control" name="end_time_pm"
               value="{{ old('end_time_pm', $route->end_time_pm ?? null) }}" required autofocus>

        @if ($errors->has('end_time_pm'))
            <span class="help-block">
                                        <strong>{{ $errors->first('end_time_pm') }}</strong>
                                    </span>
        @endif
    </div>
</div>


<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            {{ $buttonText }}
        </button>

        <a href="{{ route('list_routes') }}" class="btn btn-primary">
            Cancel
        </a>
    </div>
</div>