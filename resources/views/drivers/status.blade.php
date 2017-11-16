@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Drivers (Last payroll adjustment date: {!! $lastAdjustment !!})
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table" id="table">
                                        <thead>
                                        <th>Zone</th>
                                        <th>Route</th>
                                        <th>End AM</th>
                                        <th>End Point AM</th>
                                        <th>Start PM</th>
                                        <th>Start Point PM</th>
                                        <th>End PM</th>
                                        <th>Name</th>
                                        <th>Other Job</th>
                                        <th>Notes</th>
                                        <th>Accepted</th>
                                        <th>Declined</th>
                                        <th>Total</th>
                                        </thead>
                                        <tbody>
                                        @foreach($drivers as $driver)
                                            <tr style="background-color: {!! $driver['color'] !!};">
                                                <td>{!! $driver['zone'] !!}</td>
                                                <td>{!! $driver['route']['route_number'] !!}</td>
                                                <td>{!! $driver['route']['end_time_am'] !!}</td>
                                                <td>{!! $driver['route']['end_point_am'] !!}</td>
                                                <td>{!! $driver['route']['start_time_pm'] !!}</td>
                                                <td>{!! $driver['route']['start_point_pm'] !!}</td>
                                                <td>{!! $driver['route']['end_time_pm'] !!}</td>
                                                <td><strong>{!! $driver['first_name'] . ' ' . $driver['last_name'] !!}</strong></td>
                                                <td>{!! $driver['other_job_posted'] !!}</td>
                                                <td>{!! $driver['driver_notes'] !!}</td>
                                                <td>{!! $driver['accepted'] !!}</td>
                                                <td>{!! $driver['declined'] !!}</td>
                                                <td><strong>{!! $driver['totalHours'] !!}</strong></td>
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