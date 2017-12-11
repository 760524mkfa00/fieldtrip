@can('createPermission', Fieldtrip\Role::class)
    @foreach($rolesAll as $role)
        <tr>
            <td><strong> {!! $role->id !!}</strong></td>
            <td><strong> {!! $role->name !!}</strong></td>
            <td>
                <a class="float-left btn btn-sm btn-primary"
                   href="{{ route('create_permission', $role->id) }}">Add Permission</a>
            </td>
            <td></td>
        </tr>
        @foreach($role->permissions as $id => $permission)
            <tr>
                <td></td>
                <td></td>
                <td>{!! $id !!}</td>
                <td>
                    <a title="Remove"
                       href="{!! URL::route('remove_permission', [$role->id, $id]) !!}"
                       class="float-right"><i class="fa fa-times"></i>
                        </a>
                </td>
            </tr>
        @endforeach
    @endforeach
@endcan
@cannot('createPermission', Fieldtrip\Role::class)
    @foreach($rolesAll as $role)
        <tr>
            <td><strong> {!! $role->id !!}</strong></td>
            <td><strong> {!! $role->name !!}</strong></td>
            <td>
            </td>
            <td></td>
        </tr>
        @foreach($role->permissions as $id => $permission)
            <tr>
                <td></td>
                <td></td>
                <td>{!! $id !!}</td>
                <td>
                </td>
            </tr>
        @endforeach
    @endforeach
@endcan