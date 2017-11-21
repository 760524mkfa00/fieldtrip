<?php

namespace Fieldtrip\Providers;

use Fieldtrip\Role;
use Fieldtrip\Zone;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        \View::composer('*', function($view) {
            $zones = \Cache::rememberForever('zones', function() {
                return Zone::all();
            });

            $view->with('zones', $zones);

        });

        \View::composer('*', function($view) {
            $roles = \Cache::rememberForever('roles', function() {
                return Role::all();
            });

            $view->with('roles', array_pluck($roles, 'name', 'id'));

        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
