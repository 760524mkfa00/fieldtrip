@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <-left right->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Trips
{{--                        @can('create', Fieldtrip\Trip::class)--}}
                            <a class="pull-right btn btn-sm btn-primary" href="{{ route('create_trip') }}">New</a>
                        {{--@endcan--}}
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="table">
                                    <thead>
                                        <th>#</th>
                                        <th></th>
                                        <th>Pick Up Time</th>
                                        <th>Pick Up Location</th>
                                        <th>Drop Off Time</th>
                                        <th>Drop Off Location</th>
                                        <th>Students</th>
                                        <th></th>
                                        <th></th>
                                        <tr>
                                            <td></td>
                                            <td class="small"><strong>Name</strong></td>
                                            <td class="small"><strong>Unit</strong></td>
                                            <td class="small"><strong>Accepted</strong></td>
                                            <td class="small"><strong>Decline</strong></td>
                                            <td class="small"><strong>Hours</strong></td>
                                            <td class="small"><strong>Miles</strong></td>
                                            <td class="small"><strong>Bank</strong></td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include('trips\_partials\trips')
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

        jQuery(document).ready(function() {

            $('.table').on('click', 'button', function(e) {
                e.preventDefault();

                var myValue = $(this).attr("value");

                var formData = {
                    '_token': '<?php echo csrf_token(); ?>',
                    'accepted_hours': $("input[name=accepted_hours" + myValue + "]").val(),
                    'declined_hours': $("input[name=declined_hours" + myValue + "]").val(),
                    'hours': $("input[name=hours" + myValue + "]").val(),
                    'bank': $("input[name=bank" + myValue + "]").val(),
                    // 'overtime': $("input[name=overtime" + myValue + "]").val(),
                    'mileage': $("input[name=mileage" + myValue + "]").val(),
                    'unit': $("input[name=unit" + myValue + "]").val(),
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
                        // var errors = data.responseJSON;
                        // $.each(errors, function(index,error){
                        //     info.find('ul').append('<li>'+error+'</li>');
                        // });
                        // info.slideDown();
                        // info.delay(2500).addClass("in").slideUp(3000);
                    }

                });
                // info.hide().find('ul').empty();
                // flash.find('p').empty();
            });
        });

    </script>
@endsection