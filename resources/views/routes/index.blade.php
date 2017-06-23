@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Routes
                        @can('create', Fieldtrip\Route::class)
                            <a class="pull-right btn btn-sm btn-primary" href="{{ route('create_route') }}">New</a>
                        @endcan
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="table">
                                    <thead>
                                    <th>#</th>
                                    <th>Zone</th>
                                    <th>Route Number</th>
                                    <th>End Time AM</th>
                                    <th>End Point AM</th>
                                    <th>Start Time PM</th>
                                    <th>Start Point PM</th>
                                    <th>End Time PM</th>
                                    @can('update', Fieldtrip\Route::class)
                                        <th></th>
                                    @endcan
                                    @can('update', Fieldtrip\Route::class)
                                        <th></th>
                                    @endcan
                                    {{--<th></th>--}}
                                    </thead>
                                    <tbody>
                                    @foreach($routes as $route)
                                        <tr>
                                            <td><strong> {!! $route->id !!}</strong></td>
                                            <td><strong> {!! $route->zone->zone !!}</strong></td>
                                            <td><strong> {!! $route->route_number !!}</strong></td>
                                            <td><strong> {!! $route->end_time_am !!}</strong></td>
                                            <td>{!! $route->end_point_am !!}</td>
                                            <td>{!! $route->start_time_pm !!}</td>
                                            <td>{!! $route->start_point_pm !!}</td>
                                            <td>{!! $route->end_time_pm !!}</td>
                                            @can('update', $route)
                                                <td class="hidden-xs" style="width:2%;">
                                                    <a title="Edit"
                                                       href="{!! URL::route('update_route', $route->id) !!}"
                                                       class="pull-right"><i class="fa fa-pencil-square-o fa"></i>
                                                        <a>
                                                </td>
                                            @endcan
                                            @can('update', $route)
                                                <td class="hidden-xs" style="width:2%;">
                                                    <a title="Remove"
                                                       href="{!! URL::route('remove_route', $route->id) !!}"
                                                       class="pull-right"><i class="fa fa-times"></i>
                                                        <a>
                                                </td>
                                            @endcan
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

@section('footer')

    <script>
        $(document).ready(function () {

            $(function () {
                $('#table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'pageLength',
                        'excel',
                        {
                            extend: 'pdf',
                            exportOptions: {
                                modifier: {
                                    page: 'current'
                                }
                            },
                            pageSize: 'LETTER'
                        },
                        'print',
                        {{--{--}}
                        {{--text: 'New Route',--}}
                        {{--action: function (e, dt, node, config) {--}}
                        {{--window.location = "{!! route('create_route') !!}"--}}
                        {{--}--}}
                        {{--}--}}
                    ],
                    paging: true,
                    pageLength: 15,
                    lengthMenu: [
                        [15, 30, 60, 120, -1],
                        ['15 Rows', '30 Rows', '60 Rows', '120 Rows', 'Show All']
                    ]
                });
            });
        });
    </script>

@endsection