@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-md-4">
                <div class="card">
                    <div class="card-header">New Route</div>

                    <div class="card-body">
                        <form role="form" method="POST" action="{{ route('store_route') }}">
                            {{ csrf_field() }}

                            @include('routes/_partials/form', ['buttonText' => 'Add'])

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection