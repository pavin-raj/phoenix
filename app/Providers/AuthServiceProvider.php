<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', function($user){
            return $user->role_id == 1;
        });

        Gate::define('isCoordinator', function($user){
            return $user->role_id == 2;
        });

        Gate::define('isEmergencyResponder', function($user){
            return $user->role_id == 3;
        });

        Gate::define('isVolunteer', function($user){
            return $user->role_id == 4;
        });

        Gate::define('isCitizen', function($user){
            return $user->role_id == 5;
        });


        Gate::define('isAdminOrEmergencyResponder', function($user){
            return $user->role_id == 1 || $user->role_id == 3;
        });

    }
}
