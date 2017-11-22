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
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('store_adjustment') }}" enctype="multipart/form-data">
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

                                    <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                        <label for="csv_file" class="col-md-4 control-label">CSV file to import</label>

                                        <div class="col-md-6">
                                            <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                                            @if ($errors->has('csv_file'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="header" checked> File contains header row?
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Parse CSV
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