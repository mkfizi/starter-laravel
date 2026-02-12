<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        // Register Spatie Permission event listeners for activity logging
        // These need explicit registration as auto-discovery doesn't work for vendor package events
        \Illuminate\Support\Facades\Event::listen(
            \Spatie\Permission\Events\RoleAttachedEvent::class,
            \App\Listeners\LogRoleAttached::class
        );
        \Illuminate\Support\Facades\Event::listen(
            \Spatie\Permission\Events\RoleDetachedEvent::class,
            \App\Listeners\LogRoleDetached::class
        );
        \Illuminate\Support\Facades\Event::listen(
            \Spatie\Permission\Events\PermissionAttachedEvent::class,
            \App\Listeners\LogPermissionAttached::class
        );
        \Illuminate\Support\Facades\Event::listen(
            \Spatie\Permission\Events\PermissionDetachedEvent::class,
            \App\Listeners\LogPermissionDetached::class
        );
    }
}
