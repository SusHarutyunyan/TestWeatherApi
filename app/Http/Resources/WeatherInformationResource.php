<?php

namespace App\Http\Resources;

use App\Models\WeatherInformation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read WeatherInformation $resource
 */
class WeatherInformationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     */
    public function toArray($request): array
    {
        return [
            'time' => $this->resource->time,
            'name' => $this->resource->city->name,
            'latitude' => $this->resource->city->latitude,
            'longitude' => $this->resource->city->longitude,
            'temperature' => $this->resource->temperature,
            'pressure' => $this->resource->pressure,
            'humidity' => $this->resource->humidity,
            'min' => $this->resource->min,
            'max' => $this->resource->max,
        ];
    }
}
