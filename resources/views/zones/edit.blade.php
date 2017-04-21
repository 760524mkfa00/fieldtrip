@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Zone</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('update_zone', ['zone' => $zone->id]) }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('zone') ? ' has-error' : '' }}">
                                <label for="zone" class="col-md-4 control-label">Zone</label>

                                <div class="col-md-6">
                                    <input id="zone" type="text" class="form-control" name="zone" value="{{ old('zone', $zone->zone) }}" required autofocus>

                                    @if ($errors->has('zone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('zone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    {{--@can('publish-post')--}}
                                        {{--<a href="{{ route('publish_post', ['post' => $post->id]) }}" class="btn btn-primary">--}}
                                            {{--Publish--}}
                                        {{--</a>--}}
                                    {{--@endcan--}}
                                    <a href="{{ route('list_zones') }}" class="btn btn-primary">
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
@endsection