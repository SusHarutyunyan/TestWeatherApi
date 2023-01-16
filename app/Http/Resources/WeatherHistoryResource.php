<?php

namespace App\Http\Resources;

use App\Models\WeatherInformation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read WeatherInformation $resource
 */
class WeatherHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'time' => $this->resource->time,
            'name' => $this->resource->city->name,
            'temperature' => $this->resource->temperature,
        ];

    }
}
