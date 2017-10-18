@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Roles

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Role Name</th>
                                        <th>Roles</th>
                                        @can('update', Fieldtrip\User::class)
                                            <th>Edit</th>
                                        @endcan
                                        @can('update', Fieldtrip\User::class)
                                            <th>Remove</th>
                                        @endcan
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td><strong> {!! $role->id !!}</strong></td>
                                            <td><strong> {!! $role->name !!}</strong></td>
                                            <td>
                                                @can('create', Fieldtrip\User::class)
                                                <a class="pull-left btn btn-sm btn-primary" href="{{ route('create_role', $role->id) }}">Add Role</a>
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
                                                        @can('update',$role)
                                                            <a title="Edit"
                                                               href="{!! URL::route('update_user', $id) !!}"
                                                               class="pull-right"><i class="fa fa-pencil-square-o fa"></i>
                                                            <a>
                                                        @endcan
                                                    </td>
                                                    <td>
                                                        @can('update',$role)
                                                            <a title="Remove"
                                                               href="{!! URL::route('remove_user', $id) !!}"
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