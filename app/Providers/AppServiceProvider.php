<?php

namespace App\Providers;

use App\Contracts\City\Service\ListCityServiceInterface;
use App\Services\City\ListCityService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ListCityServiceInterface::class, ListCityService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
