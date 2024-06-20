<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('owner', function (User $user) {
            return $user->role == 'Owner';
        });

        Gate::define('admin', function (User $user) {
            return $user->role == 'Admin';
        });

        Gate::define('driver', function (User $user) {
            return $user->role == 'Driver';
        });
    }
}
