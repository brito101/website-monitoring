<?php

namespace App\Providers;

use App\Models\Check;
use App\Models\Endpoint;
use App\Models\User;
use App\Observers\CheckObserver;
use Illuminate\Database\Eloquent\Model;
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
        Check::observe(CheckObserver::class);

        Gate::define('owner', function (User $user, Model $model) {
            return $user->id === $model->user_id;
        });

        Gate::define('ownerChecks', function (User $user, Endpoint $endpoint) {
            return $user->id === $endpoint->site->user_id;
        });
    }
}
