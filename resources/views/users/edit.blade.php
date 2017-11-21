@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Users
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('update_user', $user->id) }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('employee_number') ? ' has-error' : '' }}">
                                        <label for="employee_number" class="col-md-4 control-label">Employee Number</label>

                                        <div class="col-md-6">
                                            <input id="employee_number" type="text" class="form-control" name="employee_number" value="{{ $user->employee_number }}" readonly autofocus>

                                            @if ($errors->has('employee_number'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('employee_number') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label for="first_name" class="col-md-4 control-label">First Name</label>

                                        <div class="col-md-6">
                                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required autofocus>

                                            @if ($errors->has('first_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label for="last_name" class="col-md-4 control-label">Last Name</label>

                                        <div class="col-md-6">
                                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required autofocus>

                                            @if ($errors->has('last_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('route_id') ? ' has-error' : '' }}">
                                        <label for="route_id" class="col-md-4 control-label">Route</label>
                                        <div class="col-md-6">
                                            <select id="route_id" class="form-control" name="route_id">
                                                <option value="" selected>Select Route</option>
                                                @foreach($routes as $route)
                                                    <option value="{{$route->id}}" {{ $user->route_id == $route->id ? 'selected' : '' }}>{{$route->route_number}}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('route_id'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('route_id') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('other_job_posted') ? ' has-error' : '' }}">
                                        <label for="other_job_posted" class="col-md-4 control-label">Other Job Posted</label>

                                        <div class="col-md-6">
                                            <input id="other_job_posted" type="text" class="form-control" name="other_job_posted" value="{{ $user->other_job_posted }}">

                                            @if ($errors->has('other_job_posted'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('other_job_posted') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('driver_notes') ? ' has-error' : '' }}">
                                        <label for="driver_notes" class="col-md-4 control-label">Driver Notes</label>

                                        <div class="col-md-6">
                                            <input id="driver_notes" type="text" class="form-control" name="driver_notes" value="{{ $user->driver_notes }}">

                                            @if ($errors->has('driver_notes'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('driver_notes') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('job') ? ' has-error' : '' }}">
                                        <label for="job" class="col-md-4 control-label">Job</label>
                                        <div class="col-md-6">
                                            <select id="job" class="form-control" name="job">
                                                <option value="" selected disabled hidden>Select Job</option>
                                                <option value="driver" {!! $user->job == 'driver' ? 'selected="selected"' : ''  !!}>Driver</option>
                                                <option value="office" {!! $user->job == 'office' ? 'selected="selected"' : ''  !!}>Office</option>
                                            </select>

                                            @if ($errors->has('job'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('job') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                        <label for="role" class="col-md-4 control-label">User role</label>
                                        <div class="col-md-6">
                                            <select id="role" class="form-control" name="role" required>
                                                <option value="" selected disabled hidden>Select Role</option>
                                                @foreach($roles as $id => $role)
                                                    <option value="{{$id}}" {{ $current->id == $id ? 'selected' : '' }}>{{$role}}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('role'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                                        <label for="role" class="col-md-4 control-label">Active</label>
                                        <div class="col-md-6">
                                            <select id="active" class="form-control" name="active" required>
                                                <option value="no" {!! $user->active == 'no' ? 'selected="selected"' : ''  !!}>No</option>
                                                <option value="yes" {!! $user->active == 'yes' ? 'selected="selected"' : ''  !!}>Yes</option>
                                            </select>

                                            @if ($errors->has('role'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection