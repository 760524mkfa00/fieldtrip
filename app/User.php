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
        'first_name', 'last_name', 'email', 'password', 'route_id'
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


    public static function sortedUser()
    {
        $totals = User::with('trip', 'route', 'route.zone')
            ->get();

        foreach($totals as $total) {
            $total->accepted = $total->trip->sum('pivot.accepted_hours');
            $total->declined = $total->trip->sum('pivot.declined_hours');
            $total->totalHours = $total->accepted + $total->declined;
            $total->zone = $total->route->zone->zone;
        }

        return $x = sortData($totals->toArray(), ['zone' => 'asc', 'totalHours' => 'asc', 'declined' => 'asc']);
    }



}
