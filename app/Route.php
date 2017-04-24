<?php

namespace Fieldtrip;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{

    protected $fillable = ['zone_id', 'route_number', 'end_time_am', 'end_point_am', 'start_time_pm', 'start_point_pm', 'end_time_pm'];

    public function zone()
    {
        return $this->belongsTo('Fieldtrip\Zone');
    }

    public function user()
    {
        return $this->hasMany('Fieldtrip\User');
    }

}
