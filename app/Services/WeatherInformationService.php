<?php

namespace App\Services;

use App\Facades\OpenWeather;
use App\Models\City;
use App\Models\WeatherInformation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class WeatherInformationService
{
    public function saveWeatherInformation(City $city): bool
    {
        $weatherData = OpenWeather::getWeatherDataByCoordinates($city->latitude, $city->longitude);
        if ($weatherData['success']) {
            $weatherData = $weatherData['result'];

            $exists = WeatherInformation::query()
                ->where('city_id', $city)
                ->where('time', $weatherData['dt'])
                ->exists();
            if ($exists) {
                return true;
            }
            $weatherInformation = new WeatherInformation();
            $weatherInformation->time = $weatherData['dt'];
            $weatherInformation->min = $weatherData['main']['temp_min'];
            $weatherInformation->max = $weatherData['main']['temp_max'];
            $weatherInformation->temperature = $weatherData['main']['temp'];
            $weatherInformation->pressure = $weatherData['main']['pressure'];
            $weatherInformation->humidity = $weatherData['main']['humidity'];
            $weatherInformation->city_id = $city->id;

            return $weatherInformation->save();
        }

        return false;
    }

    public function getHistory(string $day): ?Collection
    {
        $city = \App\Facades\City::getCity();
        if (!$city) {
            return null;
        }
        $start = Carbon::createFromFormat('Y-m-d', $day)->startOfDay()->getTimestamp();
        $end = Carbon::createFromFormat('Y-m-d', $day)->endOfDay()->getTimestamp();

        return WeatherInformation::query()
            ->where('city_id', $city->id)
            ->where('time' , '>=' , $start)
            ->where('time' , '<=' , $end)
            ->get();
    }
}
