<?php

namespace Fieldtrip\Http\Controllers;

use Fieldtrip\Adjustment;
use function Fieldtrip\Services\setArrayKeyNames;
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
            'adjDate' => 'required|date|unique:adjustments',
            'csv_file' => 'required|file'
        ]);

        $path = $request->file('csv_file')->getRealPath();

        $array = array_map('str_getcsv', file($path));


        // set the array keys
        $data = setArrayKeyNames($array);

        // get the active drivers from the users table
        $users = User::driver()->active()->get();


        // get rid of rows that do not have an employee number
        $filtered = $data->filter(function ($item) {
            return $item['employee_number'] > 0;
        })->map( function ($items) {
            $items['totalHours'] = ((double) ($items['timeHalf'] * 1.5) + ($items['timeDouble'] * 2) + $items['straight']);
            return $items;
        });

        //loop through drivers, for each driver loop through the filtered data, when employee numbers match, store the user ID and calculate the adjustment hours
        foreach($users as $user) {
            $dataTotal[$user->id] = ['hours' => '0'];
            foreach($filtered as $filter) {
                if($user->employee_number == $filter['employee_number']) {
                    $dataTotal[$user->id] = ['hours' => $filter['totalHours']];
                }
            }
        }

        // Save the date
        $adjustment = Adjustment::create([
            'adjDate' => $request->input('adjDate'),
        ]);


        // save the adjustment hours
        $adjustment->users()->sync($dataTotal);

        return \Redirect::route('list_adjustments')->with('flash_message', 'Adjustment has been created.');

    }

    public function show(Adjustment $adjustment)
    {

        return view('adjustments.show')
            ->withAdjustments($adjustment->load(['users' => function ($query) {
                $query->driver()->active()->orderBy('last_name');
            }]));

    }

    public function hours(Adjustment $adjustment)
    {

        return view('adjustments.hours')
            ->withAdjustments($adjustment)
            ->withUsers(User::with(['adjustments' => function($query) use($adjustment) {
                    $query->where('adjustment_id', '=', $adjustment->id);
                }])
                ->where('job','=','driver')
                ->where('active', '=', 'yes')
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
