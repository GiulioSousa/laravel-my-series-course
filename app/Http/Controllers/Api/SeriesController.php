<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
    }
    public function index()
    {
        return Series::all();
    }

    public function store(SeriesFormRequest $request)
    {
        // dd($request->all());
        // $this->seriesRepository->add($request);
        // return response()
            // ->json(Series::create($request->all()), 201);
        return response()
            ->json($this->seriesRepository->add($request), 201);
    }

    public function show (Series $series)
    // public function show (int $series)
    {
        /* $series = Series::whereId($series)
            ->with('seasons.episodes')
            // ->get();
            ->first(); */
        return $series;
    }

    // public function update(Series $series, SeriesFormRequest $request)
    public function update(int $series, SeriesFormRequest $request)
    {
        /* $series->fill($request->all());
        $series->save(); */

        Series::where('id', $series)->update($request->all());

        // return $series;
    }

    // public function destroy(Series $series)
    public function destroy(int $series)
    {
        // $series->delete();
        Series::destroy($series);
        return response()->noContent();
    }
}
