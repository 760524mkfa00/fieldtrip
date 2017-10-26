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

                                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                        <label for="role" class="col-md-4 control-label">User role</label>
                                        <div class="col-md-6">
                                            <select id="role" class="form-control" name="role" required>
                                                <option value="" selected disabled hidden>Select Role</option>
                                                @foreach($roles as $id => $role)
                                                    <option value="{{$role->id}}" {{ $current->id == $role->id ? 'selected' : '' }}>{{$role->name}}</option>
                                                @endforeach
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