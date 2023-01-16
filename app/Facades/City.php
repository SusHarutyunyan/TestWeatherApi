<?php

namespace App\Facades;

use App\Services\CityService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\City getCity()
 *
 * @see CityService
 */
class City extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CityService::class;
    }
}
