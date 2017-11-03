<?php

namespace Fieldtrip\Http\Controllers;

use Fieldtrip\Adjustment;
use Fieldtrip\User;
use Illuminate\Http\Request;

class AdjustmentController extends Controller
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
        $adjDate = Adjustment::all();

        return view('adjustments.index')
            ->withAdjustments($adjDate);
    }

    public function create()
    {
        return view('adjustments.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'adjDate' => 'required|date|unique:adjustments'
        ]);

        Adjustment::create([
            'adjDate' => $request->input('adjDate'),
        ]);
        return \Redirect::route('list_adjustments')->with('flash_message', 'Adjustment has been created.');
    }

    public function show(Adjustment $adjustment)
    {

        return view('adjustments.show')
            ->withAdjustments($adjustment->load('users'));

    }

    public function hours(Adjustment $adjustment)
    {

        return view('adjustments.hours')
            ->withAdjustments($adjustment)
            ->withUsers(User::with(['adjustments' => function($query) use($adjustment) {
                    $query->where('adjustment_id', '=', $adjustment->id);
                }])
                ->where('job','=','driver')
                ->orderBy('last_name')
                ->get());

    }

    public function storeHours(Request $request, Adjustment $adjustment)
    {

        $request->validate([
            'adjDate.*' => 'required|numeric|between:0,10000'
        ]);

        foreach($request->get('adjDate') as $key => $value) {
            $data[$key] = ['hours' => $value];
        }

        $adjustment->users()->sync($data);


        return \Redirect::route('list_adjustments')->with('flash_message', 'Adjustment have been assigned.');


    }


}
