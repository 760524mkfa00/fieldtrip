@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Roles
{{--                        @can('create', Fieldtrip\Role::class)--}}
                            <a class="pull-right btn btn-sm btn-primary" href="{{ route('create_role') }}">New Role</a>
                        {{--@endcan--}}
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Role Name</th>
                                        <th>Roles</th>
                                        @can('removePermission', Fieldtrip\Role::class)
                                            <th class="pull-right">Remove</th>
                                        @endcan
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td><strong> {!! $role->id !!}</strong></td>
                                            <td><strong> {!! $role->name !!}</strong></td>
                                            <td>
                                                @can('createPermission', Fieldtrip\Role::class)
                                                <a class="pull-left btn btn-sm btn-primary" href="{{ route('create_permission', $role->id) }}">Add Permission</a>
                                                @endcan
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            @foreach($role->permissions as $id => $permission)
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{!! $id !!}</td>
                                                    <td>
                                                        @can('removePermission',$role)
                                                            <a title="Remove"
                                                               href="{!! URL::route('remove_permission', [$role->id, $id]) !!}"
                                                               class="pull-right"><i class="fa fa-times"></i>
                                                            <a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection