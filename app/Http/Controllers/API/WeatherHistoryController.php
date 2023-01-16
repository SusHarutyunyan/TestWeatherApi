<?php

namespace App\Http\Controllers\API;

use App\Facades\WeatherInformation;
use App\Http\Controllers\Controller;
use App\Http\Resources\WeatherHistoryResource;

class WeatherHistoryController extends Controller
{

    public function history(string $day)
    {
        $history = WeatherInformation::getHistory($day);

        if ($history->isEmpty()) {
            return response()->json([
                'message' => 'No notes found.'
            ], 404);
        }

        return response()->json([
            'history' => WeatherHistoryResource::collection($history)
        ]);
    }

}
