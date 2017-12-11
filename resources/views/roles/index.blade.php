@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-5">
                <div class="card">
                    <div class="card-header">
                        Roles
                        @can('create', Fieldtrip\Role::class)
                            <a class="float-right btn btn-sm btn-primary" href="{{ route('create_role') }}">New Role</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table" id="table">
                            <thead>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Roles</th>
                                <th class="float-right">
                                @can('removePermission', Fieldtrip\Role::class)
                                    Remove
                                @endcan
                                </th>
                            </thead>
                            <tbody>
                                @include('roles/_partials/roleLoop')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection