@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-4">
                <div class="card">
                    <div class="card-header">New Zone</div>

                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('store_zone') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('zone') ? ' has-error' : '' }}">
                                <label for="zone">Zone</label>


                                    <input id="zone" type="text" class="form-control" name="zone" value="{{ old('zone') }}" required autofocus>

                                    @if ($errors->has('zone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('zone') }}</strong>
                                    </span>
                                    @endif

                            </div>

                            <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                                <label for="color">Colour (Use HEX)</label>


                                    <input id="color" type="text" class="form-control" name="color" value="{{ old('color') }}" autofocus>

                                    @if ($errors->has('color'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('color') }}</strong>
                                    </span>
                                    @endif

                            </div>


                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>
                            <a href="{{ route('list_zones') }}" class="btn btn-primary">
                                Cancel
                            </a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection