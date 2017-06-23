<?php

namespace Fieldtrip\Policies;

use Fieldtrip\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ZonePolicy
{
    use HandlesAuthorization;

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
        return $user->hasAccess(['create-zones']);
    }

    /**
     * Determine whether the user can update the zone.
     *
     * @param  \Fieldtrip\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasAccess(['update-zones']);
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
