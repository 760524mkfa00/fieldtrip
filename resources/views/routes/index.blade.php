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
                                    {{--<th>#</th>--}}
                                    <th>Zone</th>
                                    <th>Route</th>
                                    <th>Unit</th>
                                    <th>End Time AM</th>
                                    <th>End Point AM</th>
                                    <th>Start Time PM</th>
                                    <th>Start Point PM</th>
                                    <th>End Time PM</th>
                                    @can('update', Fieldtrip\Route::class)
                                        <th class="nosort"></th>
                                        <th class="nosort"></th>
                                    @endcan
                                    {{--<th></th>--}}
                                    </thead>
                                    <tbody>
                                        @can('update',  Fieldtrip\Route::class)
                                            @include('routes/_partials/adminRoutes')
                                        @else
                                            @include('routes/_partials/userRoutes')
                                        @endcan
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
                    aoColumnDefs: [{
                        'bSortable': false,
                        'aTargets': ['nosort']
                    }],
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