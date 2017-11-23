<div class="form-group{{ $errors->has('route_number') ? ' has-error' : '' }}">
    <label for="route_number">Route Number</label>


    <input id="route_number" type="text" class="form-control" name="route_number"
           value="{{ old('route_number', $route->route_number ?? null) }}" required autofocus>

    @if ($errors->has('route_number'))
        <span class="help-block">
                                        <strong>{{ $errors->first('route_number') }}</strong>
                                    </span>
    @endif

</div>

<div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
    <label for="unit">Unit</label>


    <input id="unit" type="text" class="form-control" name="unit"
           value="{{ old('unit', $route->unit ?? null) }}" autofocus>

    @if ($errors->has('unit'))
        <span class="help-block">
                                        <strong>{{ $errors->first('unit') }}</strong>
                                    </span>
    @endif

</div>

<div class="form-group{{ $errors->has('zone_id') ? ' has-error' : '' }}">
    <label for="zone_id">Zone</label>


    <select name="zone_id" id="zone_id" class="form-control">
        <option value="">Select Zone...</option>
        {!! $zones !!}
        @foreach($zones as $zone)
            <option value="{{ $zone->id }}" {{ $route->zone_id == $zone->id ? 'selected' : '' }}>
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

<div class="form-group{{ $errors->has('end_time_am') ? ' has-error' : '' }}">
    <label for="end_time_am">End Time AM</label>


    <input id="end_time_am" type="text" class="form-control" name="end_time_am"
           value="{{ old('end_time_am', $route->end_time_am ?? null) }}" required autofocus>

    @if ($errors->has('end_time_am'))
        <span class="help-block">
                                        <strong>{{ $errors->first('end_time_am') }}</strong>
                                    </span>
    @endif

</div>

<div class="form-group{{ $errors->has('end_point_am') ? ' has-error' : '' }}">
    <label for="end_point_am">End Point AM</label>

    <input id="end_point_am" type="text" class="form-control" name="end_point_am"
           value="{{ old('end_point_am', $route->end_point_am ?? null) }}" required autofocus>

    @if ($errors->has('end_point_am'))
        <span class="help-block">
                                        <strong>{{ $errors->first('end_point_am') }}</strong>
                                    </span>
    @endif

</div>

<div class="form-group{{ $errors->has('start_time_pm') ? ' has-error' : '' }}">
    <label for="start_time_pm">Start Time PM</label>

    <input id="start_time_pm" type="text" class="form-control" name="start_time_pm"
           value="{{ old('start_time_pm', $route->start_time_pm ?? null) }}" required autofocus>

    @if ($errors->has('start_time_pm'))
        <span class="help-block">
                                        <strong>{{ $errors->first('start_time_pm') }}</strong>
                                    </span>
    @endif

</div>

<div class="form-group{{ $errors->has('start_point_pm') ? ' has-error' : '' }}">
    <label for="start_point_pm">Start Point PM</label>


    <input id="start_point_pm" type="text" class="form-control" name="start_point_pm"
           value="{{ old('start_point_pm', $route->start_point_pm ?? null) }}" required autofocus>

    @if ($errors->has('start_point_pm'))
        <span class="help-block">
                                        <strong>{{ $errors->first('start_point_pm') }}</strong>
                                    </span>
    @endif

</div>

<div class="form-group{{ $errors->has('end_time_pm') ? ' has-error' : '' }}">
    <label for="end_time_pm">End Time PM</label>

    <input id="end_time_pm" type="text" class="form-control" name="end_time_pm"
           value="{{ old('end_time_pm', $route->end_time_pm ?? null) }}" required autofocus>

    @if ($errors->has('end_time_pm'))
        <span class="help-block">
                                        <strong>{{ $errors->first('end_time_pm') }}</strong>
                                    </span>
    @endif

</div>


<button type="submit" class="btn btn-primary">
    {{ $buttonText }}
</button>

<a href="{{ route('list_routes') }}" class="btn btn-primary">
    Cancel
</a>
