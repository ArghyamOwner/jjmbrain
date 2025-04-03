<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Policies\UserPolicy;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->roleGates();
        $this->permissionsGates();

        // Write your custom gates below...
        // Gate::define('view-bidding', [BiddingPolicy::class, 'view']);
    }

    public function roleGates()
    {
        Gate::before(function ($user) {
            if ($user->isSuperAdministrator()) {
                return true;
            }
        });

        Gate::define('super', function ($user) {
            if ($user->isAdministratorOrSuper()) {
                return true;
            }
        });

        Gate::define('tpa-admin', function ($user) {
            if ($user->isTpaAdmin()) {
                return true;
            }
        });

        Gate::define('district-jaldoot-cell', function ($user) {
            if ($user->isDistrictJaldootCell()) {
                return true;
            }
        });

        Gate::define('state-jaldoot-cell', function ($user) {
            if ($user->isStateJaldootCell()) {
                return true;
            }
        });

        Gate::define('admin-or-state-jaldoot-cell', function ($user) {
            if ($user->isAdministratorOrStateJaldootCell()) {
                return true;
            }
        });

        Gate::define('lab-ho', function ($user) {
            if ($user->isLabHo()) {
                return true;
            }
        });

        Gate::define('lab-nodal-officer', function ($user) {
            if ($user->isLabNodalOfficer()) {
                return true;
            }
        });

        Gate::define('lab-admin', function ($user) {
            if ($user->isLabAdmin()) {
                return true;
            }
        });
        
        foreach (array_keys(config('freshman.roles')) as $role) {
            Gate::define(Str::camel($role), function ($user) use ($role) {
                return $user->role === $role;
            });
        }
    }

    public function permissionsGates()
    {
        foreach (config('freshman.permissions') as $permission) {
            Gate::define(Str::camel($permission), function ($user) use ($permission) {
                // if (in_array($permission, $user->permissions)) {
                //     return true;
                // }
                if ($user->hasPermission($permission)) {
                    return true;
                }
            });
        }
    }
}
