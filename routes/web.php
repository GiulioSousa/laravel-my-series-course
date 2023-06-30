<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Autenticador;
use App\Mail\SeriesCreated;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    // return view('welcome');
    return redirect('/series');
})->middleware(Autenticador::class); */


/* Método 1 */
/* Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
Route::get('/series/create', [SeriesController::class, 'create'])->name('series.create');
Route::post('/series/store', [SeriesController::class, 'store'])->name('series.store');
// Route::post('/series/destroy/{idSerie}', [SeriesController::class, 'destroy'])->name('series.destroy');
Route::delete('/series/destroy/{idSerie}', [SeriesController::class, 'destroy'])->name('series.destroy');
Route::get('/series/{idSerie}/edit', [SeriesController::class, 'edit'])->name('series.edit'); */

/* Método 2 */
/* Route::controller(SeriesController::class)->group(function () {
    Route::get('/series', 'index')->name('series.index');
    Route::get('/series/criar', 'create')->name('series.create');
    Route::post('/series/salvar', 'store')->name('series.store');
    // Route::post('/series/apagar/{idSerie}', 'destroy')->name('series.destroy');
    Route::delete('/series/apagar/{idSerie}', 'destroy')->name('series.destroy');
    Route::get('/series/{idSerie}/editar', 'edit')->name('series.edit');
}); */

/* Método 3 */
/* Route::resource('/series', SeriesController::class)
->only(['index', 'create', 'store', 'destroy', 'edit', 'update']); */

/* Route::get('/', function () {
    return redirect('/series');
});
Route::resource('/series', SeriesController::class)
->except(['show']); */

/* Route::resource('/series', SeriesController::class)
->except(['show'])
->middleware(Autenticador::class); */

// Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');
// Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index')->middleware(Autenticador::class);

Route::middleware('autenticador')->group(function () {
    Route::get('/', function () {
        return redirect('/series');
    });
    Route::resource('/series', SeriesController::class)
        ->except(['show']);
    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index')->middleware('autenticador');

    Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
    Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'update'])->name('episodes.update');
});

/* Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index')->middleware('autenticador');

Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'update'])->name('episodes.update'); */
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('signIn');
Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');


Route::get('/email', function () {
    return new SeriesCreated(
        'série teste',
        1,
        8,
        10
    );
});

