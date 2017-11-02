@foreach($trip->user as $user)
    <form class="form-horizontal" role="form" method="POST" action="{{ route('store_hours', $user->pivot->id) }}">
        {{ csrf_field() }}
        <tr style="color: blue;">
            <td></td>
            <td><a href="{!! route('edit_user', $user->id) !!}">{!! $user->first_name . ' ' . $user->last_name !!}</a></td>
            <td><input id="unit" type="text" class="form-control" name="unit{!! $user->pivot->id !!}" value="{!! $user->pivot->unit ?? $user->route->unit !!}" required autofocus></td>
            <td><input id="accepted_hours" type="text" class="form-control" name="accepted_hours{!! $user->pivot->id !!}" value="{!! $user->pivot->accepted_hours !!}" required autofocus></td>
            <td><input id="declined_hours" type="text" class="form-control" name="declined_hours{!! $user->pivot->id !!}" value="{!! $user->pivot->declined_hours !!}" required autofocus></td>
            <td><input id="hours" type="text" class="form-control" name="hours{!! $user->pivot->id !!}" value="{!! $user->pivot->hours !!}" required autofocus></td>
            <td><input id="mileage" type="text" class="form-control" name="mileage{!! $user->pivot->id !!}" value="{!! $user->pivot->mileage !!}" required autofocus></td>
            {{--<td><input id="bank" type="text" class="form-control" name="bank{!! $user->pivot->id !!}" value="{!! $user->pivot->bank !!}" required autofocus>--}}

            <td>
                {{--<input type="hidden" name="bank{!! $user->pivot->id !!}" value="0">--}}
                <input type="checkbox" name="bank{!! $user->pivot->id !!}" value="{!! $user->pivot->bank !!}" {{ ($user->pivot->bank == 1) ? 'checked="checked"' : '' }}>
            </td>

            <td><button type="submit" name="button" class="small" value="{!! $user->pivot->id !!}">Save</button></td>
        </tr>
    </form>
@endforeach