@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Adjustments
                        @can('create', Fieldtrip\User::class)
                            <a class="pull-right btn btn-sm btn-primary" href="{{ route('create_adjustment') }}">New</a>
                        @endcan
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th class="">View</th>
                                        <th class="pull-right">Add Adjustments</th>
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
        </div>
    </div>
@endsection
