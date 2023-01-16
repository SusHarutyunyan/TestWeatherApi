<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenWeatherService
{
    protected const SUCCESS_RESPONSE_CODE = 200;

    protected const DEFAULT_API_ERROR_LOG_CONTEXT = 'OpenWeatherApiError';

    protected string $apiBaseUrl = 'https://api.openweathermap.org/data/2.5/';

    protected string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    protected function apiCall(string $apiFullUrl):array
    {
        $result = Http::get($apiFullUrl)->json();
        $success = false;

        if ($result['cod'] == self::SUCCESS_RESPONSE_CODE) {
            $success = true;
        }

        return [
            'success' => $success,
            'result' => $result
        ];
    }


    public function getWeatherDataByCoordinates(float $latitude, float $longitude, string $units = 'metric'): array
    {
        $apiUrl = 'weather?lat=%s&lon=%s&appid=%s&units=%s';
        $apiFullUrl = sprintf($this->apiBaseUrl . $apiUrl, $latitude, $longitude, $this->apiKey, $units);

        $result = $this->apiCall($apiFullUrl);

        if (!$result['success']) {
            $message = $result['message'] ?? 'Open Weather Api error.';
            $message .= ' Latitude: %s, Longitude: %s';
            Log::error(sprintf($message, $latitude, $longitude), [self::DEFAULT_API_ERROR_LOG_CONTEXT]);
        }

        return $result;
    }

    public function getCityInfoByName(string $name): array
    {
        $apiUrl = 'weather?q=%s&appid=%s';
        $apiFullUrl = sprintf($this->apiBaseUrl . $apiUrl, $name, $this->apiKey);

        $result = $this->apiCall($apiFullUrl);
        if (!$result['success']) {
            $result['message'] .= ' Name: %s';
            Log::error(sprintf($result['message'], $name), [self::DEFAULT_API_ERROR_LOG_CONTEXT]);
        }

        return $result;
    }
}
