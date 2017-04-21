@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Posts
                        @can('create-zone')
                            <a class="pull-right btn btn-sm btn-primary" href="{{ route('create_zone') }}">New</a>
                        @endcan
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            @foreach($zones as $zone)
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h3><a href="{{ route('edit_zone', ['id' => $zone->id]) }}">{{ $zone->zone }}</a></h3>
                                            <p>{{ str_limit($zone->name, 50) }}</p>
                                            @can('update-zone', $zone)
                                                <p>
                                                    <a href="{{ route('edit_zone', ['id' => $zone->id]) }}" class="btn btn-sm btn-default" role="button">Edit</a>
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