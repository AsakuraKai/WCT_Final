<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SteamApiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SteamApiService::class, function ($app) {
            return new SteamApiService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
