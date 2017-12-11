@can('update',Fieldtrip\User::class)
    @foreach($users as $user)
        <tr>
            <td><strong> {!! $user->employee_number !!}</strong></td>
            <td><strong> {!! $user->first_name !!}</strong></td>
            <td><strong> {!! $user->last_name !!}</strong></td>
            <td><strong> {!! $user->email !!}</strong></td>
            <td>{!! $user->route->route_number ?? '' !!}</td>
            <td>{!! $user->roles->first()->name ?? NULL !!}</td>
            <td class="hidden-xs" style="width:2%;">
                <a title="Edit"
                   href="{!! URL::route('update_user', $user->id) !!}"
                   class="pull-right"><i class="fa fa-pencil-square-o fa"></i>
                </a>
            </td>
            <td class="hidden-xs" style="width:2%;">
                <a title="Remove"
                   href="{!! URL::route('remove_user', $user->id) !!}"
                   class="pull-right"><i class="fa fa-times"></i>
                    </a>
            </td>
        </tr>
    @endforeach
@endcan
@cannot('update',Fieldtrip\User::class)
    @foreach($users as $user)
        <tr>
            <td><strong> {!! $user->employee_number !!}</strong></td>
            <td><strong> {!! $user->first_name !!}</strong></td>
            <td><strong> {!! $user->last_name !!}</strong></td>
            <td><strong> {!! $user->email !!}</strong></td>
            <td>{!! $user->route->route_number ?? '' !!}</td>
            <td>{!! $user->roles->first()->name ?? NULL !!}</td>
        </tr>
    @endforeach
@endcan