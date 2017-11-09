@component('mail::message')
# Hello {{ $trip->user->first()->first_name }}

You have been added to the following trip.

- Trip # {{ $trip->field_trip_number }}
- Date # {{ $trip->trip_date }}
- Pick up Time # {{ $trip->pickup_time }}
- Pick Location # {{ $trip->pickup_location }}
- Return Pick up Time # {{ $trip->dropoff_time }}
- Return Pickup Location # {{ $trip->dropoff_location }}
- Students # {{ $trip->student_count }}
- Notes # {{ $trip->fieldtrip_notes }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
