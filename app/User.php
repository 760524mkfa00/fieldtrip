<?php

namespace Fieldtrip;

use function Fieldtrip\Services\sortData;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'route_id', 'other_job_posted', 'driver_notes', 'job'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function adjustments()
    {
        return $this->belongsToMany(Adjustment::class, 'adjustment_users')
            ->withPivot('hours')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function route()
    {
        return $this->belongsTo('Fieldtrip\Route', 'route_id');
    }

    /**
     * Checks if User has access to $permissions.
     */
    public function hasAccess(array $permissions) : bool
    {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if($role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if the user belongs to role.
     */
    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }

    public function trip()
    {
        return $this->belongsToMany('Fieldtrip\Trip')
            ->withPivot('accepted_hours', 'declined_hours')->withTimestamps();
    }


    public function sortedUser()
    {
        $totals = User::with('trip', 'route', 'route.zone', 'adjustments')
            ->where('job', '=', 'driver')
            ->get();

        $totals->lastAdjustment = Adjustment::LastAdjustmentDate();

        foreach($totals as $total) {
            $total->accepted = $this->acceptedTotal($total, $totals->lastAdjustment);
            $total->declined = $total->trip->sum('pivot.declined_hours');
            $total->totalHours = $total->accepted + $total->declined;
            $total->zone = $total->route->zone->zone ?? 'ZZZ';
            $total->color = $total->route->zone->color ?? '#ffffff';
        }

        return $x = sortData($totals->toArray(), ['zone' => 'asc', 'totalHours' => 'asc', 'declined' => 'asc']);
    }


    public function acceptedTotal($total, $adjustmentDate)
    {
        $adjustmentHours = $total->adjustments->where('adjDate', '=', $adjustmentDate)->first()->pivot->hours ?? 0.0;
        $acceptedHours = $total->trip->where('trip_date', '>', $adjustmentDate)->sum('pivot.accepted_hours');

        return $adjustmentHours + $acceptedHours;
    }



}
