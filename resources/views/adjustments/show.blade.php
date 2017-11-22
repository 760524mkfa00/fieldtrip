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
                                <table class="table" id="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Hours</th>
                                    </thead>
                                    <tbody>
                                    @foreach($adjustments->users as $user)
                                        <tr>
                                            <td><strong> {!! $user->employee_number !!}</strong></td>
                                            <td><strong> {!! $user->first_name . ' ' . $user->last_name !!}</strong></td>
                                            <td><strong> {!! $user->pivot->hours !!}</strong></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
