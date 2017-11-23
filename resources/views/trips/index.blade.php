@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                @include('trips/_partials/filter')
                            </div>
                            <div class="col">
                                {{--@can('create', Fieldtrip\Trip::class)--}}
                                <a class="float-right btn btn-sm btn-primary" href="{{ route('create_trip') }}">New</a>
                                {{--@endcan--}}
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div id="errors"></div>
                        <table class="table table-responsive" id="table">
                            <thead class="thead-dark">
                                <th scope="col">#</th>
                                <th scope="col"></th>
                                <th scope="col" width="7%">Pick Up Time</th>
                                <th scope="col">Pick Up Location</th>
                                <th scope="col" width="7%">Drop Off Time</th>
                                <th scope="col">Drop Off Location</th>
                                <th scope="col">Hours</th>
                                <th scope="col">Students</th>
                                <th scope="col" colspan="3">Note</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
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
                                    <td></td>
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
                window.location.reload(true);
                // window.location.href=self.location.href
                // window.location.href=window.location.href
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