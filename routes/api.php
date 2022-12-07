<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Route\RouteController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Route\RoutesByUserController;
use App\Http\Controllers\Api\Google\GooglePlacesController;

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

Route::post('register', [RegisterController::class, 'create']);
Route::post('auth/token', [AuthController::class, 'auth']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/me', [AuthController::class, 'me']);
    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::put('user', [UserController::class, 'update']);
    Route::get('user/routes', RoutesByUserController::class);

    Route::post('routes', [RouteController::class, 'store']);
    Route::delete('routes/{id}', [RouteController::class, 'destroy']);
});


Route::post('/places', [GooglePlacesController::class, 'index']);

Route::get('ok', function () {
    return response()->json('ok');
});
