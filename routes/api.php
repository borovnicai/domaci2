<?php

use App\Http\Controllers\UserController;
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

Route::post('login', [UserController::class, 'ulogujSe']);
Route::post('register', [UserController::class, 'registujSe']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('sale', \App\Http\Controllers\SalaController::class);
    Route::resource('filmovi', \App\Http\Controllers\FilmController::class);
    Route::resource('prikazivanja', \App\Http\Controllers\PrikazivanjeController::class);
});
