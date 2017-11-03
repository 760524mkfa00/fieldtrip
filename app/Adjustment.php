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

}
