<?php

use App\Http\Controllers\Api\EpisodesController;
use App\Http\Controllers\Api\SeasonsController;
use App\Http\Controllers\Api\SeriesController;
// use App\Http\Controllers\ApiSeriesController;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::get('/series', function () {
    // return ['God od Blackfield'];
    return Series::all();
}); */

// Route::get('/series', [SeriesController::class, 'index']);
// Route::post('/series', [SeriesController::class, 'store']);

Route::apiResource('/series', SeriesController::class);
/* Route::get('/series/{series}/seasons', function (Series $series) {
    return $series->seasons;
}); */
Route::get('/series/{series}/seasons', [SeasonsController::class, 'show']);
Route::get('/series/{series}/episodes', [EpisodesController::class, 'show']);

Route::patch('/episodes/{episode}', [EpisodesController::class, 'watched']);


