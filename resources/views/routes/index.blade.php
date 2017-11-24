@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Routes
                        @can('create', Fieldtrip\Route::class)
                            <a class="float-right btn btn-sm btn-primary" href="{{ route('create_route') }}">New Route</a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive-xl" style="border-collapse: collapse !important;" id="table">
                            <thead class="thead-grey">
                            {{--<th>#</th>--}}
                            <th scope="col">Zone</th>
                            <th scope="col">Route</th>
                            <th scope="col">Unit</th>
                            <th scope="col">End Time AM</th>
                            <th scope="col">End Point AM</th>
                            <th scope="col">Start Time PM</th>
                            <th scope="col">Start Point PM</th>
                            <th scope="col">End Time PM</th>
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
                    pageLength: 120,
                    lengthMenu: [
                        [15, 30, 60, 120, -1],
                        ['15 Rows', '30 Rows', '60 Rows', '120 Rows', 'Show All']
                    ]
                });
            });
        });
    </script>

@endsection