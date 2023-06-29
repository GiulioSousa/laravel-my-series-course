<?php

use App\Http\Controllers\Api\EpisodesController;
use App\Http\Controllers\Api\SeasonsController;
use App\Http\Controllers\Api\SeriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:sanctum')->group(function () {
 
    Route::apiResource('/series', SeriesController::class);
    
    Route::get('/series/{series}/seasons', [SeasonsController::class, 'show']);
    Route::get('/series/{series}/episodes', [EpisodesController::class, 'show']); 
    Route::patch('/episodes/{episode}', [EpisodesController::class, 'watched']);
});

Route::post('/login', function (Request $request) {
    $credentials = $request->only(['email', 'password']);
    // $user = \App\Models\User::whereEmail($credentials['email'])->first();
    // $passwordAuth = \Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password);

    // if (is_null($user) || !$passwordAuth) {
    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Usuário não encontrado'], 401);
    }

    $user = Auth::user();
    $user->tokens()->delete();
    $token = $user->createToken('token', ['series:delete']);

    // return response()->json(['message' => "Bem vindo, $user->email"], 200);
    // return response()->json(['message' => "Bem vindo, " . $credentials['email']], 200);
    return response()->json($token->plainTextToken);
});


