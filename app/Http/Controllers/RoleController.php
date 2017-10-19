<?php

namespace Fieldtrip\Http\Controllers;

use Fieldtrip\Role;
use Illuminate\Http\Request;


/**
 * Class RoleController
 * @package Fieldtrip\Http\Controllers
 */
class RoleController extends Controller
{

    /**
     * Show a list of roles.
     *
     * @return mixed
     */
    public function index()
    {
        return view('roles.index')
            ->withRoles(Role::all());
    }


    /**
     * Create a role.
     *
     * @param Role $role
     * @return mixed
     */
    public function create()
    {

        return view('roles.create');
    }

    /**
     * Save a role.
     *
     * @param Role $role
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {


        Role::create([
            'name' => $request->input('name'),
            'slug' => strtolower($request->input('name')),
            'permissions' => ['read-only' => true]
        ]);

        return \Redirect::route('list_role')->with('flash_message', 'Role has been created.');

    }



    /**
     * Create a permission for a role.
     *
     * @param Role $role
     * @return mixed
     */
    public function createPermission(Role $role)
    {

        return view('roles.permission')
            ->withRole($role);
    }

    /**
     * Save a permission to selected role.
     *
     * @param Role $role
     * @param Request $request
     * @return mixed
     */
    public function storePermission(Role $role, Request $request)
    {

        $role->permissions = array_add($role->permissions, $request->permissions, true);

        $role->save();

        return \Redirect::route('list_role')->with('flash_message', 'Permission has been created.');

    }


    /**
     * Removed a permission from role.
     *
     * @param Role $role
     * @param $permission
     * @return mixed
     */
    public function destroyPermission(Role $role, $permission)
    {

        $array = $role->permissions;
        unset($array[$permission]);

        $role->permissions = $array;

        $role->save();

        return \Redirect::route('list_role')->with('flash_message', 'Permission has been removed.');

    }
}
