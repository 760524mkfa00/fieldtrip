<?php

namespace Fieldtrip\Policies;

use Fieldtrip\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdjustmentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view the zone.
     *
     * @param  \Fieldtrip\User  $user
     * @param  \Fieldtrip\Zone  $zone
     * @return mixed
     */
//    public function view(User $user, Zone $zone)
//    {
//        //
//    }

    /**
     * Determine whether the user can create zones.
     *
     * @param  \Fieldtrip\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['create-adjustment']);
    }

    /**
     * Determine whether the user can update the zone.
     *
     * @param  \Fieldtrip\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasAccess(['update-adjustment']);
    }

    /**
     * Determine whether the user can delete the zone.
     *
     * @param  \Fieldtrip\User  $user
     * @param  \Fieldtrip\Zone  $zone
     * @return mixed
     */
//    public function delete(User $user, Zone $zone)
//    {
//        //
//    }
}
