@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Adjustments
                        @can('create', Fieldtrip\User::class)
                            <a class="pull-right btn btn-sm btn-primary" href="{{ route('create_adjustment') }}">New</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table" id="table">
                            <thead class="thead-dark">
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">View</th>
                                <th scope="col">OT Report</th>
                                <th scope="col" class="text-right">Add Adjustments</th>
                            </thead>
                            <tbody>
                            @foreach($adjustments as $adjustment)
                                <tr>
                                    <td><strong> {!! $adjustment->id !!}</strong></td>
                                    <td><strong> {!! $adjustment->adjDate !!}</strong></td>
                                    <td>
                                        <a title="View"
                                           href="{!! URL::route('show_adjustment', $adjustment->id) !!}"
                                           class=""><i class="fa fa-eye fa"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a title="View"
                                           href="{!! URL::route('ot_report', $adjustment->adjDate) !!}"
                                           class=""><i class="fa fa-eye fa"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a title="Edit"
                                           href="{!! URL::route('edit_adjustment', $adjustment->id) !!}"
                                           class="pull-right"><i class="fa fa-pencil-square-o fa"></i>
                                            </a>
                                    </td>
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
