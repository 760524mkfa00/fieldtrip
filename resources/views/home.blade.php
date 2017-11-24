@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">My Trips</div>

                <div class="card-body">
                    <table class="table table-responsive-xl" id="table">
                        <caption>Legend: (1 - Straight Time, 1.5 - Overtime, 2 - Double Time)</caption>
                        <thead class="thead-grey">
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Pick Up Time</th>
                            <th scope="col">Pick Up Location</th>
                            <th scope="col">Return Time</th>
                            <th scope="col">Return Pick up Location</th>
                            <th scope="col">1</th>
                            <th scope="col">1.5</th>
                            <th scope="col">2</th>
                            <th scope="col">Bank</th>
                        </thead>
                        <tbody>
                            @foreach($user->trip as $trip)
                                <tr>
                                    <td scope="row">{!! $trip->field_trip_number !!}</td>
                                    <td>{!! $trip->trip_date->format('M d, Y') !!}</td>
                                    <td>{!! $trip->pickup_time !!}</td>
                                    <td>{!! $trip->pickup_location !!}</td>
                                    <td>{!! $trip->dropoff_time !!}</td>
                                    <td>{!! $trip->dropoff_location !!}</td>
                                    <td>{!! $trip->pivot->one !!}</td>
                                    <td>{!! $trip->pivot->oneHalf !!}</td>
                                    <td>{!! $trip->pivot->two !!}</td>
                                    <td>{!! $trip->pivot->bank !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfooter>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Totals</strong></td>
                                <td>{!! $user->oneTotal !!}</td>
                                <td>{!! $user->oneHalfTotal !!}</td>
                                <td>{!! $user->twoTotal !!}</td>
                                <td></td>
                            </tr>
                        </tfooter>
                    </table>
                    {{--<p class="small">Legend: (1 - Straight Time, 1.5 - Overtime, 2 - Double Time)</p>--}}
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
                            // exportOptions: {
                            //     columns: [ 1, 2, 3, 4, 5, 6, 7, 10, 11, 12 ]
                            // },
                            customize : function(doc) {
                                // doc.pageMargins = [10, 10, 10,10 ];
                                doc.content[1].table.widths =
                                    Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            }
                        },
                        {
                            extend: 'print',
                            orientation: 'landscape',
                            // exportOptions: {
                            //     columns: [ 1, 2, 3, 4, 5, 6, 7, 10, 11, 12 ]
                            // },
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