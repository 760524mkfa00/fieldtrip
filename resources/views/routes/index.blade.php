@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Routes
                        @can('create-route')
                            <a class="pull-right btn btn-sm btn-primary" href="{{ route('create_route') }}">New</a>
                        @endcan
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            @foreach($routes as $route)
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h3><a href="{{ route('edit_route', ['id' => $route->id]) }}">{{ $route->route_number }}</a></h3>
                                            <p>{{ str_limit($route->route_number, 50) }}</p>
                                            @can('update-route', $route)
                                                <p>
                                                    <a href="{{ route('edit_route', ['id' => $route->id]) }}" class="btn btn-sm btn-default" role="button">Edit</a>
                                                </p>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection