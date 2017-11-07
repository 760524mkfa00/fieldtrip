<?php

namespace Fieldtrip;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['zone', 'color'];


//    public function userTotals()
//    {
//        $data = \DB::table('users')->select('users.id','first_name', 'last_name')
//            ->groupBy('user_id')
//            ->selectRaw('sum(accepted_hours) as accepted')
//            ->selectRaw('sum(declined_hours) as declined')
//            ->selectRaw('sum(accepted_hours) + sum(declined_hours) as total')
//            ->join('fieldtrip_user', 'user_id', '=', 'users.id')
//            ->orderBy('total', 'asc')
//            ->get();
//
//        return $data;
//    }
}
