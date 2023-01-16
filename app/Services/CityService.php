<?php

namespace App\Services;

use App\Models\City;

class CityService
{
    public function getCity()
    {
        return City::query()->where([
            'name' => env('OPEN_WEATHER_CURRENT_CITY'),
        ])->first();
    }

}
