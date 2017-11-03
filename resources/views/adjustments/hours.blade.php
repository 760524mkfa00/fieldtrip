@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {!! $adjustments->adjDate !!}
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('store_hours', $adjustments->id) }}">
                                    {{ csrf_field() }}
                                    <table class="table" id="table">
                                        <thead>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Hours</th>
                                            <th>Messages</th>
                                        </thead>
                                        <tbody>

                                            <div class="row">
                                                @foreach($users as $user)
                                                    <tr>
                                                        {{--<input type="hidden" value="{{ $user->id }}" name="userid[{{ $user->id }}]">--}}
                                                        <td><strong> {!! $user->id !!}</strong></td>
                                                        <td><strong> {!! $user->first_name . ' ' . $user->last_name !!}</strong></td>
                                                        <td><input id="adjDate" type="adjDate" class="form-control" name="adjDate[{{ $user->id }}]" value="{!! old("adjDate.$user->id", $user->adjustments->first()->pivot->hours ?? '0') !!}" required></td>
                                                        @if($errors->first("adjDate.$user->id"))
                                                            <td style="color:red;">{{ $errors->first("adjDate.$user->id") }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </div>

                                        </tbody>
                                    </table>
                                    <div class="">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="">
                                                    <button type="submit" class="btn btn-primary">
                                                        Add
                                                    </button>
                                                    <a href="{{ route('list_adjustments') }}" class="btn btn-primary">
                                                        Cancel
                                                    </a>
                                                </div>
                                            </div>
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
