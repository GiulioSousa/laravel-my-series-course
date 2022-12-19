<?php

namespace App\Http\Controllers;

// use App\Models\Season;
use App\Models\Series;

class SeasonsController extends Controller
{
    public function index(Series $series)
    // public function index(int $series)
    {
        /* $seasons = Season::query()
            ->with('episodes')
            ->where('series_id', $series)
            ->get(); */
        $seasons = $series->seasons()->with('episodes')->get();

        // return view('seasons.index')->with('seasons', $temporadas);
        return view('seasons.index')->with('seasons', $seasons)->with('series', $series);
        // return view('seasons.index')->with('seasons', $seasons);
    }
}
