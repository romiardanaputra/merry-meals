<?php

namespace App\Providers;

use App\Models\Order;
use App\Policies\OrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // User Management Gates
        Gate::define('manage-users', fn($user) => 
            in_array($user->role, ['superadmin', 'admin'])
        );

        Gate::define('manage-all-users', fn($user) => 
            $user->role === 'superadmin'
        );

        Gate::define('create-users', fn($user) => 
            in_array($user->role, ['superadmin', 'admin'])
        );

        Gate::define('delete-users', fn($user) => 
            $user->role === 'superadmin'
        );

        // Order Management Gates
        Gate::define('view-all-orders', fn($user) => 
            in_array($user->role, ['superadmin', 'admin'])
        );

        Gate::define('assign-driver', fn($user) => 
            in_array($user->role, ['superadmin', 'admin'])
        );

        Gate::define('manage-orders', fn($user) => 
            in_array($user->role, ['superadmin', 'admin'])
        );

        // Meal Management Gates
        Gate::define('manage-meals', fn($user) => 
            in_array($user->role, ['superadmin', 'admin', 'partner'])
        );

        Gate::define('create-meals', fn($user) => 
            in_array($user->role, ['superadmin', 'partner'])
        );

        // Partner Management Gates
        Gate::define('view-partners', fn($user) => 
            in_array($user->role, ['superadmin', 'admin'])
        );

        Gate::define('approve-partners', fn($user) => 
            in_array($user->role, ['superadmin', 'admin'])
        );

        Gate::define('manage-partners', fn($user) => 
            $user->role === 'superadmin'
        );

        // Donation Management Gates
        Gate::define('view-donations', fn($user) => 
            in_array($user->role, ['superadmin', 'admin'])
        );

        Gate::define('manage-donations', fn($user) => 
            in_array($user->role, ['superadmin', 'admin'])
        );

        // Reports Gates
        Gate::define('view-reports', fn($user) => 
            in_array($user->role, ['superadmin', 'admin'])
        );

        Gate::define('view-full-reports', fn($user) => 
            $user->role === 'superadmin'
        );

        // Settings Gate
        Gate::define('manage-settings', fn($user) => 
            $user->role === 'superadmin'
        );

        // Driver-specific Gates
        Gate::define('toggle-availability', fn($user) => 
            $user->role === 'driver'
        );

        Gate::define('update-delivery-status', fn($user) => 
            in_array($user->role, ['superadmin', 'admin', 'driver'])
        );

        // Partner-specific Gates
        Gate::define('manage-kitchen-status', fn($user) => 
            in_array($user->role, ['superadmin', 'partner'])
        );

        Gate::define('manage-meal-availability', fn($user) => 
            in_array($user->role, ['superadmin', 'partner'])
        );
    }
}
