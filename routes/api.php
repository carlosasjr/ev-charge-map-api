<?php

use App\Http\Controllers\Api\Google\GooglePlacesController;
use App\Http\Controllers\Api\Route\RouteController;
use App\Http\Controllers\Api\Route\RoutesByUserController;
use App\Http\Controllers\Api\User\UserController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'index']);
    Route::put('user', [UserController::class, 'update']);
    Route::get('user/routes', RoutesByUserController::class);

    Route::post('routes', [RouteController::class, 'store']);
    Route::delete('routes/{id}', [RouteController::class, 'destroy']);
});


Route::post('/places', [GooglePlacesController::class, 'index']);

Route::get('ok', function () {
    return response()->json('ok');
});
