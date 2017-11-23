@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-md-6">
                <div class="card">
                    <div class="card-header">
                        Create Adjustment
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('store_adjustment') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('adjDate') ? ' has-error' : '' }}">
                                <label for="adjDate">Date (YYYY-MM-DD)</label>
                                <input id="adjDate" type="adjDate" class="form-control" name="adjDate" required>

                                @if ($errors->has('adjDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adjDate') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                <label for="csv_file">CSV file to import</label>
                                <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                                @if ($errors->has('csv_file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="header" checked>
                                    File contains header row?
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Parse CSV
                            </button>
                            <a href="{{ route('list_adjustments') }}" class="btn btn-primary">
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection