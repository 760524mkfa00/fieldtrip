<div class="table-responsive">
    <table class="table table-condensed" id="table">
        <thead>
        <th>#</th>
        <th>Pick Up Time</th>
        <th>Pick Up Location</th>
        <th>Return Time</th>
        <th>Return Location</th>
        <th>Students</th>
        <th colspan="5">Note</th>

        </thead>
        <tbody>
        <tr>
            <td><strong>{!! $trip->field_trip_number !!} </strong></td>
            <td><strong>{!! $trip->pickup_time !!}</strong></td>
            <td><strong>{!! $trip->pickup_location !!}</strong></td>
            <td><strong>{!! $trip->dropoff_time !!}</strong></td>
            <td><strong>{!! $trip->dropoff_location !!}</strong></td>
            <td><strong>{!! $trip->student_count !!}</strong></td>
            <td style="color: red;" colspan="5"><strong>{!! $trip->fieldtrip_notes !!}</strong></td>

        </tr>
        <tr>
            <td></td>
            <td class="small"><strong>Name</strong></td>
            <td class="small"><strong>Unit</strong></td>
            {{--<td class="small"><strong>Hours</strong></td>--}}
            <td colspan="4" class="small"><strong>Notes</strong></td>
            <td>Straight</td>
            <td>Over Time</td>
            <td>Double OT</td>
            <td>Mileage</td>
        </tr>
        <tr>
            <td></td>
            <td>{!! $trip->user->first()->first_name . ' ' . $trip->user->first()->last_name !!}</td>
            <td>{!! $trip->user->first()->pivot->unit ?? $trip->user->first()->route->unit ?? 'none' !!}</td>
            <td colspan="4">{!! $trip->user->first()->pivot->note !!}</td>
            <td>{{ $trip->user->first()->pivot->one }}</td>
            <td>{{ $trip->user->first()->pivot->oneHalf }}</td>
            <td>{{ $trip->user->first()->pivot->two }}</td>
            <td>{{ $trip->user->first()->pivot->mileage }} Kms</td>
        </tr>
        </tbody>
    </table>
</div>