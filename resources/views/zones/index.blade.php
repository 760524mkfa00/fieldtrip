@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Zones
                        @can('create', Fieldtrip\Zone::class)
                            <a class="pull-right btn btn-sm btn-primary" href="{{ route('create_zone') }}">New</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($zones as $zone)
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h3><a href="{{ route('edit_zone', ['id' => $zone->id]) }}">{{ $zone->zone }}</a></h3>
                                            <p>{{ str_limit($zone->name, 50) }}</p>
                                            <p>{{ str_limit($zone->color, 10) }}</p>
                                            @can('update', $zone)
                                                <p>
                                                    <a href="{{ route('edit_zone', ['id' => $zone->id]) }}" class="btn btn-sm btn-default" role="button">Edit</a>
                                                </p>
                                            @endcan
                                            @can('update', $zone)
                                                <p>
                                                    <a href="{{ route('remove_zone', ['id' => $zone->id]) }}" class="btn btn-sm btn-default" role="button">Remove</a>
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