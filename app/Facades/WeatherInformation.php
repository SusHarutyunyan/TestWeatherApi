<?php

namespace App\Facades;

use App\Services\WeatherInformationService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool saveWeatherInformation(\App\Models\City $city)
 * @method static ?Collection getHistory(string $day)
 *
 * @see WeatherInformationService
 */
class WeatherInformation extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return WeatherInformationService::class;
    }
}
