<?php

namespace Fieldtrip\Http\Controllers;

use Fieldtrip\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::with('trip')->where('id',Auth()->id())->first();

        $user->oneTotal = $user->trip->sum('pivot.one');
        $user->oneHalfTotal = $user->trip->sum('pivot.oneHalf');
        $user->twoTotal = $user->trip->sum('pivot.two');

        return view('home')
            ->withUser($user);

    }
}
