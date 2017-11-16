@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            {{--<div class="col-md-1">--}}
                                {{--Trips--}}
                            {{--</div>--}}
                            <div class="col-md-11">
                                @include('trips/_partials/filter')
                            </div>
                            <div class="col-md-1">
                                {{--@can('create', Fieldtrip\Trip::class)--}}
                                <a class="pull-right btn btn-sm btn-primary" href="{{ route('create_trip') }}">New</a>
                                {{--@endcan--}}
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="errors"></div>
                                <div class="table-responsive">
                                    <table class="table table-condensed" id="table">
                                        <thead>
                                            <th>#</th>
                                            <th></th>
                                            <th width="7%">Pick Up Time</th>
                                            <th>Pick Up Location</th>
                                            <th width="7%">Drop Off Time</th>
                                            <th>Drop Off Location</th>
                                            <th>Students</th>
                                            <th colspan="3">Note</th>
                                            <th></th>
                                            <th></th>
                                            <tr>
                                                <td></td>
                                                <td class="small"><strong>Name</strong></td>
                                                <td class="small"><strong>Unit</strong></td>
                                                <td class="small"><strong>Accepted</strong></td>
                                                <td class="small"><strong>Decline</strong></td>
                                                <td class="small"><strong>Note</strong></td>

                                                <td class="small" width="8%"><strong></strong></td>
                                                <td class="small" width="8%"><strong></strong></td>
                                                <td class="small" width="8%"><strong></strong></td>

                                                <td class="small" width="8%"><strong></strong></td>
                                                <td class="small" ><strong>Bank</strong></td>
                                                <td class="small"><strong></strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @include('trips/_partials/trips')
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

    <script>

        jQuery(document).ready(function() {



            $('.table').on('click', 'button', function(e) {
                e.preventDefault();

                var myValue = $(this).attr("value");

                var formData = {
                    '_token': '<?php echo csrf_token(); ?>',
                    'accepted_hours': $("input[name=accepted_hours" + myValue + "]").val(),
                    'declined_hours': $("input[name=declined_hours" + myValue + "]").val(),
                    'one': $("input[name=one" + myValue + "]").val(),
                    'oneHalf': $("input[name=oneHalf" + myValue + "]").val(),
                    'two': $("input[name=two" + myValue + "]").val(),
                    'bank': $("select[name=bank" + myValue + "]").val(),
                    'mileage': $("input[name=mileage" + myValue + "]").val(),
                    'unit': $("input[name=unit" + myValue + "]").val(),
                    'note': $("input[name=note" + myValue + "]").val(),
                    'response': $("select[name=response" + myValue + "]").val(),
                    'button': myValue
                };
                $.ajax({
                    type: 'PUT',
                    url: 'drivers/' + myValue,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        // info.hide().find('ul').empty();
                        // flash.find('p').append(data.message);
                        // flash.slideDown();
                        // $(".alert").delay(2500).addClass("in").slideUp(2000);

                    },
                    error: function (data) {

                        // Log in the console
                        var response = data.responseJSON;
                        // console.log(errors);

                        // or, what you are trying to achieve
                        // render the response via js, pushing the error in your
                        // blade page
                        errorsHtml = '<div class="alert alert-danger"><ul>';

                        $.each( response.errors, function( key, value ) {
                            errorsHtml += '<li>'+ value + '</li>'; //showing only the first error.
                        });
                        errorsHtml += '</ul></div>';


                        $( '#errors' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form

                        $('#errors').delay(2500).addClass("in").slideUp(3000);

                    }

                });
                // info.hide().find('ul').empty();
                // flash.find('p').empty();
            });



            $(function() {
                $('#myselect').change(function() {
                    var val = $(this).val();

                    if(val === "Custom") {
                        $('#start_range').removeAttr('hidden');
                        $('#end_range').removeAttr('hidden');
                    }

                    if(val === "This Week") {
                        $('#start_range').val(moment().startOf('isoWeek').format('YYYY-MM-DD'));
                        $('#end_range').val(moment().endOf('isoWeek').format('YYYY-MM-DD'));
                        $( "#submit" ).submit();
                    }

                    if(val === "This month") {
                        $('#start_range').val(moment().startOf('month').format('YYYY-MM-DD'));
                        $('#end_range').val(moment().endOf('month').format('YYYY-MM-DD'));
                    }

                    if(val === "Last Week") {
                        $('#start_range').val(moment().subtract(1, 'weeks').startOf('isoWeek').format('YYYY-MM-DD'));
                        $('#end_range').val(moment().subtract(1, 'weeks').endOf('isoWeek').format('YYYY-MM-DD'));
                    }

                    if(val === "Last month") {
                        $('#start_range').val(moment().subtract(1, 'months').startOf('month').format('YYYY-MM-DD'));
                        $('#end_range').val(moment().subtract(1, 'months').endOf('month').format('YYYY-MM-DD'));
                    }

                    if(val === "Next Week") {
                        $('#start_range').val(moment().add(1, 'weeks').startOf('isoWeek').format('YYYY-MM-DD'));
                        $('#end_range').val(moment().add(1, 'weeks').endOf('isoWeek').format('YYYY-MM-DD'));
                    }

                    if(val === "Today") {
                        $('#start_range').val(moment().format('YYYY-MM-DD'));
                        $('#end_range').val(moment().format('YYYY-MM-DD'));
                    }

                });
            });


        });

    </script>
@endsection