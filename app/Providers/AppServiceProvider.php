<?php

namespace App\Providers;

use App\Contracts\City\Repository\ListCityRepositoryInterface;
use App\Contracts\City\Service\ListCityServiceInterface;
use App\Contracts\City\Service\CepServiceInterface;
use App\Repositories\City\ListCityRepository;
use App\Services\City\ListCityService;
use App\Services\City\CepService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ListCityRepositoryInterface::class, ListCityRepository::class);
        $this->app->bind(ListCityServiceInterface::class, ListCityService::class);
        $this->app->bind(CepServiceInterface::class, CepService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
