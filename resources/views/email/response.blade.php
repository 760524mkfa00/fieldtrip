@component('mail::message')

# Hello {{ $trip->user->first()->first_name . ' ' . $trip->user->first()->last_name }}

You {{ $trip->user->first()->pivot->response }} the following trip at {{ $trip->user->first()->pivot->response_time }}.

- Trip # {{ $trip->field_trip_number }}
- Date # {{ $trip->trip_date }}
- Pick up Time # {{ $trip->pickup_time }}
- Pick Location # {{ $trip->pickup_location }}
- Return Pick up Time # {{ ($trip->dropoff_time == 0) ? 'One way trip' :  $trip->dropoff_time }}
- Drop off / Return Pickup Location # {{ $trip->dropoff_location }}
- Students # {{ $trip->student_count }}
- Notes # {{ $trip->fieldtrip_notes }}

@if($trip->user->first()->pivot->response === 'accepted')

    Use the link to submit your hours once field trip is complete. You will need to log in.

    @component('mail::button', ['url' => config('app.url') . "/trips/submit/hours/{$url}"] )
        Submit Hours
    @endcomponent
@endif


Thanks,<br>
{{ config('app.name') }}
@endcomponent
