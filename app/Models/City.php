<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

/**
 * @property-read int $id
 * @property string $name
 * @property float $latitude
 * @property float $longitude
 *
 * @method static Builder query()
 */
class City extends Model
{

    protected $fillable = [
        'name' , 'latitude', 'longitude'
    ];

    /**
     * @inheritdoc
     */
    public $timestamps = false;

    /**
     * Relation to weather information
     */
    public function weatherInformation(): HasMany
    {
        return $this->hasMany(WeatherInformation::class);
    }
}
