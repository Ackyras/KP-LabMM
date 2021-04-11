<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user) {
            if ($user->role == 'superadmin') {
                return true;
            }
        });
        Gate::define('inventaris', function ($user) {
            return $user->role == 'inventaris' or $user->role == 'superadmin';
        });
        Gate::define('ruangan', function ($user) {
            return $user->role == 'ruangan' or $user->role == 'superadmin';
        });
        Gate::define('asprak', function ($user) {
            return $user->role == 'asprak' or $user->role == 'superadmin' or $user->role == 'dosen';
        });
        Gate::define('openverbek', function ($user) {
            return $user->role == 'asprak' or $user->role == 'superadmin';
        });
        Gate::define('nilai', function ($user) {
            return $user->role == 'dosen' or $user->role == 'superadmin' or $user->role == 'asprak';
        });
    }
}
