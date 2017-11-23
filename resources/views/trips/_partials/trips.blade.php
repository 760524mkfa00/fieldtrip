@foreach($trips as $key => $tripDate)
    <tr>
        <td colspan="13" style="background-color: azure; font-size: 1.5em; font-weight: bolder;">{!! $key !!}</td>
    </tr>
    @foreach($tripDate as $trip)
        <tr style="{!! ($trip->user->count() ? '' : 'background-color: #ffe6e6') !!}">
            <td><strong>
                    <a href="{{ route('edit_trip', $trip->id) }}" class="" style="color: red;">
                        {!! $trip->field_trip_number !!}
                    </a>
                </strong></td>
            <td><a title="Assign Driver"
                   href="{!! URL::route('assign_driver', $trip->id) !!}"
                   class="" style="color:blue;"><i class="fa fa-plus"></i>
                </a></td>
            <td><strong>{!! $trip->pickup_time !!}</strong></td>
            <td><strong>{!! $trip->pickup_location !!}</strong></td>
            <td><strong>{!! $trip->dropoff_time !!}</strong></td>
            <td><strong>{!! $trip->dropoff_location !!}</strong></td>
            <td><strong>{!! $trip->hours !!}</strong></td>
            <td><strong>{!! $trip->student_count !!}</strong></td>
            <td colspan="3" style="color: red;"><strong>{!! $trip->fieldtrip_notes !!}</strong></td>
            <td>
                <a title="email"
                   href="{!! route('email_driver', $trip) !!}"
                   class=""><i class="fa fa-envelope-o" aria-hidden="true"></i>
                </a>
            </td>
            {{--TODO: Check user can remove trip--}}
            <td>
                <a title="Remove"
                   href="{!! URL::route('remove_trip', $trip->id) !!}"
                   class="" style="color:red;"><i class="fa fa-times"></i>
                </a>
            </td>
        </tr>
        @if($trip->user->count())
            @include('trips/_partials/tripUser')
        @endif
    @endforeach
@endforeach