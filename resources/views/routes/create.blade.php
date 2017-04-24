@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Route</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('store_route') }}">
                            {{ csrf_field() }}

                            @include('routes/_partials/form', ['buttonText' => 'Add'])

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection