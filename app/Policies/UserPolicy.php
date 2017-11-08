<?php

namespace Fieldtrip\Policies;

use Fieldtrip\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create users.
     *
     * @param  \Fieldtrip\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['create-user']);
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \Fieldtrip\User  $user
     * @return mixed
     */
    public function update(User $user, $id = null)
    {
        if(! is_null($id)) {
            if ($user->id === $id->id) {
                return true;
            }
        }

        return $user->hasAccess(['update-user']);
    }


}
