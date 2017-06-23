<?php

namespace Fieldtrip\Policies;

use Fieldtrip\User;
use Fieldtrip\Route;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoutePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the route.
     *
     * @param  \Fieldtrip\User  $user
     * @param  \Fieldtrip\Route  $route
     * @return mixed
     */
//    public function view(User $user, Route $route)
//    {
//        //
//    }

    /**
     * Determine whether the user can create routes.
     *
     * @param  \Fieldtrip\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['create-route']);
    }

    /**
     * Determine whether the user can update the route.
     *
     * @param  \Fieldtrip\User  $user
     * @param  \Fieldtrip\Route  $route
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasAccess(['update-route']);
    }

    /**
     * Determine whether the user can delete the route.
     *
     * @param  \Fieldtrip\User  $user
     * @param  \Fieldtrip\Route  $route
     * @return mixed
     */
//    public function delete(User $user, Route $route)
//    {
//        //
//    }
}
