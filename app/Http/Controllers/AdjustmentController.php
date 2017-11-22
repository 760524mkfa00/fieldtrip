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
            'adjDate' => 'required|date|unique:adjustments',
            'csv_file' => 'required|file'
        ]);

        $path = $request->file('csv_file')->getRealPath();

        $array = array_map('str_getcsv', file($path));

        $header = ['name', 'employee_number', 'job', 'ohrs1', 'timeHalf', 'timeDouble', 'straight'];

        $i = 0;

        foreach ($array as $row)
        {

            foreach($header as $index => $value)
            {
                $data[$i][$value] = $row[$index];
            }
            $i++;
        }

        $data = collect($data);

        $filtered = $data->filter(function ($item) {
            return $item['employee_number'] > 0;
        });


        $adjustment = Adjustment::create([
            'adjDate' => $request->input('adjDate'),
        ]);


        $users = User::where('job','=','driver')
                ->where('active', '=', 'yes')
                ->get();


        $dataTotal = [];
        foreach($users as $user)
        {
            foreach($filtered as $filter)
            {

                if($user->employee_number == $filter['employee_number']) {
                    $total = (double) ($filter['timeHalf'] * 1.5) + ($filter['timeDouble'] * 2) + $filter['straight'];
                    $dataTotal[$user->id] = ['hours' => $total];
                }
            }
        }

        $adjustment->users()->sync($dataTotal);

        return \Redirect::route('list_adjustments')->with('flash_message', 'Adjustment has been created.');
    }

    public function show(Adjustment $adjustment)
    {

        return view('adjustments.show')
            ->withAdjustments($adjustment->load(['users' => function ($query) {
                $query->where('active', '=', 'yes');
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
