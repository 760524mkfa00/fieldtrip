@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create Permission for {!! $role->name !!}
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('store_permission',$role->id) }}">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('permissions') ? ' has-error' : '' }}">
                                        <label for="permissions" class="col-md-4 control-label">Enter Permission</label>

                                        <div class="col-md-8">
                                            <input id="permissions" type="permissions" class="form-control" name="permissions" required>

                                            @if ($errors->has('permissions'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('permissions') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
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