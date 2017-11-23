@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-5">
                <div class="card">
                    <div class="card-header">
                        {!! $adjustments->adjDate !!}
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('store_hours', $adjustments->id) }}">
                            {{ csrf_field() }}
                            <table class="table" id="table">
                                <thead class="thead-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Hours</th>
                                    {{--<th scope="col">Messages</th>--}}
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
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                                <a href="{{ route('list_adjustments') }}" class="btn btn-primary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
