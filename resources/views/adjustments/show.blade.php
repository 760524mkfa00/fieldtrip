@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-5">
                <div class="card">
                    <div class="card-header">
                        {!! $adjustments->adjDate !!}
                    </div>
                    <div class="panel-body">
                        <table class="table" id="table">
                            <thead class="thead-grey">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Hours</th>
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
@endsection
