<?php

namespace App\Console\Commands;

use App\Facades\OpenWeather;
use App\Facades\WeatherInformation;
use App\Models\City;
use Illuminate\Console\Command;

class UpdateWeatherInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:weather-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update weather info';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $city = \App\Facades\City::getCity();

        if (!$city) {
            $cityName = env('OPEN_WEATHER_CURRENT_CITY');
            $apiCityInfo = OpenWeather::getCityInfoByName($cityName);

            if ($apiCityInfo['success']) {
                $city = new City();
                $coordinates = $apiCityInfo['result']['coord'];
                $city->fill([
                    'name' => $cityName,
                    'latitude' => $coordinates['lat'],
                    'longitude' => $coordinates['lon']
                ]);
                $city->save();
                $city->refresh();
            }
        }

        if ($city) {
            WeatherInformation::saveWeatherInformation($city);
        }
    }
}
