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


    public function trip()
    {
        return $this->with('user')
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->trip_date)->format('D M d, y');
            });

    }

    public function user()
    {
        return $this->belongsToMany('Fieldtrip\User')->withPivot('id', 'unit', 'accepted_hours', 'declined_hours', 'hours','bank', 'mileage')->withTimestamps();
    }

}
