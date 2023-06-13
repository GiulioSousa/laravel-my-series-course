<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;

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
        return response()
            ->json($this->seriesRepository->add($request), 201);
    }

    public function show (int $series)
    {
            $seriesModel = Series::with('seasons.episodes')->find($series);
            if ($seriesModel === null) {
                return response()->json(['message' => 'Série não encontrada'], 404);
            }

        return $seriesModel;
    }

    public function update(int $series, SeriesFormRequest $request)
    {
        Series::where('id', $series)->update($request->all());
    }

    public function destroy(int $series)
    {
        Series::destroy($series);
        return response()->noContent();
    }
}
