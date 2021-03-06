<?php

namespace Fieldtrip;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{

    protected $fillable = ['field_trip_number', 'trip_date', 'pickup_time', 'pickup_location', 'dropoff_time', 'dropoff_location', 'student_count', 'fieldtrip_notes', 'hours'];

    public function getDates()
    {
        return array('created_at', 'updated_at', 'trip_date');
    }


    public function tripFilter(array $filter)
    {

        return $this->with('user.route', 'user')
            ->DateFilter($filter["start_range"], $filter["end_range"])
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->trip_date)->format('D M d, y');
            });

    }

    public function user()
    {
        return $this->belongsToMany('Fieldtrip\User')
            ->withPivot('id', 'unit', 'accepted_hours', 'declined_hours', 'bank', 'mileage','note', 'one', 'oneHalf', 'two', 'response', 'response_time', 'hours_submitted')
            ->withTimestamps();
    }

    public function scopeDateFilter($query, $startDate, $endDate)
    {
        $query->where('trip_date', '>=', $startDate)->where('trip_date', '<=', $endDate);
    }


    public function singleTripUser(array $data)
    {
//        return $this->with(['user' => function($query) use($data) {
//            $query->where('user_id', '=', $data['1'])->first();
//        }])->where('id', $data['0'])->first();

        return $this->with(['user' => function($query) use($data) {
            $query->where('user_id', $data['1'])->first();
        }])->find($data['0']);

    }


    public function storeUserTrip($id, array $data)
    {
        if(array_key_exists('response_time', $data)) {
            $hours = ($data['accepted_hours'] > $data['declined_hours'])? $data['accepted_hours'] : $data['declined_hours'];

            if($data['response'] === 'declined')
            {
                $data['accepted_hours'] = 0;
                $data['declined_hours'] = $hours;
            } else {
                $data['accepted_hours'] = $hours;
                $data['declined_hours'] = 0;
            }
        }

        \DB::table('trip_user')
            ->where('id', $id)
            ->update($data);

        return true;

    }




}
