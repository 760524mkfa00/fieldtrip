
    <table class="table table-responsive-xl" id="table">
        <thead class="thead-grey">
            <th scope="col">#</th>
            <th scope="col">Pick Up Time</th>
            <th scope="col">Pick Up Location</th>
            <th scope="col">Return Time</th>
            <th scope="col">Return Location</th>
            <th scope="col">Students</th>
            <th scope="col" colspan="6">Note</th>
        </thead>
        <tbody>
        <tr>
            <td><strong>{!! $trip->field_trip_number !!} </strong></td>
            <td><strong>{!! $trip->pickup_time !!}</strong></td>
            <td><strong>{!! $trip->pickup_location !!}</strong></td>
            <td><strong>{!! $trip->dropoff_time !!}</strong></td>
            <td><strong>{!! $trip->dropoff_location !!}</strong></td>
            <td><strong>{!! $trip->student_count !!}</strong></td>
            <td style="color: red;" colspan="6"><strong>{!! $trip->fieldtrip_notes !!}</strong></td>

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
            <td>Bank</td>
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
            <td>{{ ucfirst($trip->user->first()->pivot->bank) }}</td>
        </tr>
        </tbody>
    </table>