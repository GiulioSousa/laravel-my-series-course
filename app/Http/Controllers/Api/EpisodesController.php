<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Series;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function show(Series $series)
    {
        if ($series === null) {
            return response()->json(['message' => 'Série não encontrada'], 404);
        }

        return $series->episodes()->get();
    }

    public function watched(Episode $episode, Request $request) {
        $episode->watched = $request->watched;
        $episode->save();

        return $episode;
    }
}