@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-md-4">
                <div class="card">
                    <div class="card-header">Update Route</div>

                    <div class="card-body">
                        <form role="form" method="POST" action="{{ route('update_route', ['route' => $route->id]) }}">
                            {{ csrf_field() }}

                            @include('routes/_partials/form', ['buttonText' => 'Update'])

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection