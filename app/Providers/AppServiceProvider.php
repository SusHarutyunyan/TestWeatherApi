<?php

namespace App\Providers;

use App\Services\CityService;
use App\Services\OpenWeatherService;
use App\Services\WeatherInformationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(CityService::class, function ($app) {
            return new CityService();
        });

        $this->app->singleton(OpenWeatherService::class, function ($app) {
            return new OpenWeatherService(env('OPEN_WEATHER_API_KEY', ''));
        });

        $this->app->singleton(WeatherInformationService::class, function ($app) {
            return new WeatherInformationService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
