@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create Adjustment
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('store_adjustment') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('adjDate') ? ' has-error' : '' }}">
                                        <label for="adjDate" class="col-md-4 control-label">Date (YYYY-MM-DD)</label>

                                        <div class="col-md-8">
                                            <input id="adjDate" type="adjDate" class="form-control" name="adjDate" required>

                                            @if ($errors->has('adjDate'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('adjDate') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Add
                                            </button>
                                            <a href="{{ route('list_adjustments') }}" class="btn btn-primary">
                                                Cancel
                                            </a>
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