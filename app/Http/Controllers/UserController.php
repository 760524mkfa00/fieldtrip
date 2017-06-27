<?php

namespace Fieldtrip\Http\Controllers;

use Fieldtrip\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Fieldtrip\Http\Requests\UpdateUser as UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::with('roles')->get();

        return view('users.index')
            ->withUsers($users);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        //
//    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {

        $current = $user->roles()->first();

        return view('users.edit')
            ->withUser($user)
            ->withCurrent($current);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, user $user)
    {
        $data = $request->only('first_name', 'last_name', 'email');
        $user->fill($data)->save();

        $user->roles()->sync($request->get('role'));

        return redirect()->route('list_users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        if(User::count() < 2) return \Redirect::back()->withErrors('Trip Connect needs at least 1 user.');

        try {
            $user->delete();
        }
        catch(\Exception $e)
        {
            return \Redirect::back()->withErrors('That\'s is not going to happen anytime soon, it would seem this user is being used with other data.');
        }

        return \Redirect::route('list_users')->with('flash_message', 'User has been removed.');
    }
}
