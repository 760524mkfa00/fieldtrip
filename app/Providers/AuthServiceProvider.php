<?php

namespace Fieldtrip\Providers;

use Fieldtrip\Zone;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Fieldtrip\Model' => 'Fieldtrip\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->registerZonePolicies();
    }

    public function registerZonePolicies()
    {
        Gate::define('create-zones', function ($user) {
            return $user->hasAccess(['create-zones']);
        });
        Gate::define('update-zones', function ($user, Zone $zone) {
            return $user->hasAccess(['update-zones']);
        });
//        Gate::define('publish-zone', function ($user) {
//            return $user->hasAccess(['publish-zone']);
//        });
//        Gate::define('see-all-drafts', function ($user) {
//            return $user->inRole('editor');
//        });
    }
}
