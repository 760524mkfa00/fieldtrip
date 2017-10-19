<?php

namespace Fieldtrip\Policies;

use Fieldtrip\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class RolePolicy
 * @package Fieldtrip\Policies
 */
class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create a role.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasAccess(['add-role']);
    }

    /**
     * Determine whether the user can remove a role.
     *
     * @param User $user
     * @return bool
     */
    public function remove(User $user)
    {
        return $user->hasAccess(['remove-role']);
    }

    /**
     * Determine whether the user can create a permission.
     *
     * @param User $user
     * @return bool
     */
    public function createPermission(User $user)
    {
        return $user->hasAccess(['add-permission']);
    }

    /**
     * Determine whether the user can remove a permission.
     *
     * @param User $user
     * @return bool
     */
    public function removePermission(User $user)
    {
        return $user->hasAccess(['remove-permission']);
    }
}
