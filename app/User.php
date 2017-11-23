<?php

namespace Fieldtrip;

use function Fieldtrip\Services\sortData;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package Fieldtrip
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'route_id', 'other_job_posted', 'driver_notes', 'job', 'employee_number', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
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


    /**
     * Creates the pivot relation between users and trips
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function trip()
    {
        return $this->belongsToMany('Fieldtrip\Trip')
            ->withPivot('id', 'unit', 'accepted_hours', 'declined_hours', 'bank', 'mileage','note', 'one', 'oneHalf', 'two', 'response', 'response_time', 'hours_submitted')
            ->withTimestamps();
    }


    /**
     * Gets all active drivers and calculates the overtime
     * @param null $date
     * @return array
     */
    public function sortedUser($date = NULL)
    {
        $totals = User::with('trip', 'route', 'route.zone', 'adjustments')
            ->driver()
            ->active()
            ->get();

        $totals->lastAdjustment = $date ?? Adjustment::LastAdjustmentDate();

        foreach($totals as $total) {
            if($date == NULL) {
                $total->accepted = $this->acceptedTotal($total, $totals->lastAdjustment);
                $total->declined = $total->trip->sum('pivot.declined_hours');
            } else {
                $total->accepted = $this->acceptedTotalBefore($total, $totals->lastAdjustment);
                $total->declined = $total->declinedTotalBefore($total, $totals->lastAdjustment);
            }
            $total->totalHours = $total->accepted + $total->declined;
            $total->zone = $total->route->zone->zone ?? 'ZZZ';
            $total->color = $total->route->zone->color ?? '#ffffff';
        }

        return $x = sortData($totals->toArray(), ['zone' => 'asc', 'totalHours' => 'asc', 'declined' => 'asc']);
    }


    /**
     * @param $total
     * @param $adjustmentDate
     * @return float
     */
    public function acceptedTotal($total, $adjustmentDate)
    {
        $adjustmentHours = $total->adjustments->where('adjDate', '=', $adjustmentDate)->first()->pivot->hours ?? 0.0;
        $acceptedHours = $total->trip->where('trip_date', '>', $adjustmentDate)->sum('pivot.accepted_hours');

        return $adjustmentHours + $acceptedHours;
    }


    /**
     * @param $total
     * @param $adjustmentDate
     * @return mixed
     */
    public function declinedTotalBefore($total, $adjustmentDate)
    {

        $adjDate = date('Y-m-d', strtotime($adjustmentDate . ' +1 day'));

        return $total->trip->where('trip_date', '<', $adjDate)->sum('pivot.declined_hours');
    }

    /**
     * @param $total
     * @param $adjustmentDate
     * @return float
     */
    public function acceptedTotalBefore($total, $adjustmentDate)
    {
        return $total->adjustments->where('adjDate', '=', $adjustmentDate)->first()->pivot->hours ?? 0.0;
    }




    /**
     * Scope a query to only include Drivers.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDriver($query)
    {
        return $query->where('job','=','driver');
    }

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', '=', 'yes');
    }




}
