<?php

namespace Fieldtrip;

use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{

    protected $fillable = [
        'adjDate'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'adjustment_users')
            ->withPivot('hours')
            ->withTimestamps();
    }

    public static function LastAdjustmentDate()
    {
        $data = Adjustment::max('adjDate');
        return (is_null($data)) ? $data = '2000-01-01' :  $data;

    }


}
