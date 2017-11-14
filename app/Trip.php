<?php

namespace Fieldtrip;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{

    protected $fillable = ['field_trip_number', 'trip_date', 'pickup_time', 'pickup_location', 'dropoff_time', 'dropoff_location', 'student_count', 'fieldtrip_notes'];

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
            ->withPivot('id', 'unit', 'accepted_hours', 'declined_hours', 'bank', 'mileage','note', 'one', 'oneHalf', 'two', 'response', 'response_time')
            ->withTimestamps();
    }

    public function scopeDateFilter($query, $startDate, $endDate)
    {
        $query->where('trip_date', '>=', $startDate)->where('trip_date', '<=', $endDate);
    }


    public function singleTripUser($userID, $tripID)
    {
        return $this->with(['user' => function($query) use($userID) {
            $query->where('user_id', '=', $userID)->limit(1);
        }])->where('id', $tripID)->first();

    }


}
