<?php

namespace App\Providers;

use App\Contracts\City\Service\ListCityServiceInterface;
use App\Contracts\City\Service\ViaCepServiceInterface;
use App\Services\City\ListCityService;
use App\Services\City\ViaCepService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ListCityServiceInterface::class, ListCityService::class);
        $this->app->bind(ViaCepServiceInterface::class, ViaCepService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
