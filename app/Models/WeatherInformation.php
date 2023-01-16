<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property int $city_id
 * @property Carbon $time
 * @property float $temperature
 *
 * @property-read City $city
 */
class WeatherInformation extends Model
{
    /**
     * @inheritdoc
     */
    public $timestamps = false;

    /**
     * Get time parsed to human-readable datetime.
     */
    protected function time(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::createFromTimestamp($value)->toDateTimeString(),
        );
    }

    /**
     * Relation to city
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
