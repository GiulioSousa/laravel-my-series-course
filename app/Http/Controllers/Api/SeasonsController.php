<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;

class SeasonsController extends Controller
{
    public function show(Series $series)
    {
        if ($series === null) {
            return response()->json(['message' => 'Série não encontrada'], 404);
        }

        return $series->seasons()->get();
    }
}
