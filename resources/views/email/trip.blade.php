@component('mail::message')

# Hello {{ $user->first_name . ' ' . $user->last_name }}

You have been added to the following trip.

- Trip # {{ $trip->field_trip_number }}
- Date # {{ $trip->trip_date }}
- Pick up Time # {{ $trip->pickup_time }}
- Pick Location # {{ $trip->pickup_location }}
- Return Pick up Time # {{ ($trip->dropoff_time == 0) ? 'One way trip' :  $trip->dropoff_time }}
- Drop off / Return Pickup Location # {{ $trip->dropoff_location }}
- Students # {{ $trip->student_count }}
- Notes # {{ $trip->fieldtrip_notes }}

@component('mail::button', ['url' => config('app.url') . "/trips/response/{$url}"] )
    Respond
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
