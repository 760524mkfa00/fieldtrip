@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-heading">
                        Drivers (Last payroll adjustment date: {!! $lastAdjustment !!})
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-xl" style="border-collapse: collapse !important;" id="table">
                            <thead class="thead-grey">
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
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: [ 1, 2, 3, 4, 5, 6, 7, 10, 11, 12 ]
                            },
                            customize : function(doc) {
                                // doc.pageMargins = [10, 10, 10,10 ];
                                doc.content[1].table.widths =
                                    Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                                }
                        },
                        {
                            extend: 'print',
                            orientation: 'landscape',
                            exportOptions: {
                                columns: [ 1, 2, 3, 4, 5, 6, 7, 10, 11, 12 ]
                            },
                            customize: function ( win ) {
                                $(win.document.body)
                                    .css( 'font-size', '10pt' )
                                    .prepend(
                                        '<img src="https://www.busboss.com/hubfs/layout-2017/home/block1-bus.png" style="position:absolute; top:0; right:0; opacity: .1; width: 400px;" />'
                                    );

                                $(win.document.body).find( 'table' )
                                    .addClass( 'compact table-sm' )
                                    .css( 'font-size', 'inherit' );
                            }
                        }
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