@foreach($trip->user as $user)
    <form role="form" method="POST" action="{{ route('store_hours', $user->pivot->id) }}">
        {{ csrf_field() }}
        <tr style="color: blue;" class="userData" data-pivot="{!! $user->pivot->id !!}">
            <td>
                <select id='response' class="form-control form-control-sm" name="response{!! $user->pivot->id !!}" {!! $user->pivot->response == 'accepted' ? 'style="color:green; font-weight:bold;"' : ''  !!}>
                    <option value="">No Response</option>
                    <option value="accepted" {!! $user->pivot->response == 'accepted' ? 'selected="selected"' : ''  !!}>Accept</option>
                    <option value="declined" {!! $user->pivot->response == 'declined' ? 'selected="selected"' : ''  !!}>Decline</option>
                </select>
            </td>
            <td><a href="{!! route('edit_user', $user->id) !!}">{!! $user->first_name . ' ' . $user->last_name !!}</a></td>
            <td><input id="unit" type="text" class="form-control form-control-sm" name="unit{!! $user->pivot->id !!}" value="{!! $user->pivot->unit ?? $user->route->unit ?? 'none' !!}" required autofocus></td>
            <td width="7%"><input id="accepted_hours" type="text" class="form-control form-control-sm" name="accepted_hours{!! $user->pivot->id !!}" value="{!! $user->pivot->accepted_hours !!}" required autofocus></td>
            <td width="7%"><input id="declined_hours" type="text" class="form-control form-control-sm" name="declined_hours{!! $user->pivot->id !!}" value="{!! $user->pivot->declined_hours !!}" required autofocus></td>
            <td ><input id="note" type="text" class="form-control form-control-sm" style="color: red;" name="note{!! $user->pivot->id !!}" value="{!! $user->pivot->note !!}" autofocus></td>
            <td>
                <div class="input-group input-group-sm">
                    <div class="input-group-addon">1</div>
                    <input id="one" type="text" class="form-control form-control-sm" name="one{!! $user->pivot->id !!}" value="{!! $user->pivot->one !!}" required autofocus>
                </div>
            </td>
            <td>
                <div class="input-group input-group-sm">
                    <div class="input-group-addon">1.5</div>
                    <input id="oneHalf" type="text" class="form-control form-control-sm" name="oneHalf{!! $user->pivot->id !!}" value="{!! $user->pivot->oneHalf !!}" required autofocus>
                </div>
            </td>
            <td>
                <div class="input-group input-group-sm">
                    <div class="input-group-addon">2</div>
                    <input id="two" type="text" class="form-control form-control-sm" name="two{!! $user->pivot->id !!}" value="{!! $user->pivot->two !!}" required autofocus>
                </div>
            </td>
            <td>
                <div class="input-group input-group-sm">
                    <div class="input-group-addon">KM</div>
                    <input id="mileage" type="text" class="form-control form-control-sm" name="mileage{!! $user->pivot->id !!}" value="{!! $user->pivot->mileage !!}" required autofocus>
                </div>
            </td>

            {{--<td><input id="bank" type="text" class="form-control" name="bank{!! $user->pivot->id !!}" value="{!! $user->pivot->bank !!}" required autofocus>--}}

            <td>
                <select id='bank' class="form-control form-control-sm" name="bank{!! $user->pivot->id !!}">
                    <option value="no" {!! $user->pivot->bank == 'no' ? 'selected="selected"' : ''  !!}>No</option>
                    <option value="yes" {!! $user->pivot->bank == 'yes' ? 'selected="selected"' : ''  !!}>Yes</option>
                </select>
            </td>

            <td><button type="submit" name="button" class="small" value="{!! $user->pivot->id !!}">Save</button></td>
            <td></td>
        </tr>
    </form>
@endforeach