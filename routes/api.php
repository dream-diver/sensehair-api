<?php

use App\Http\Resources\UserResource;
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
    return new UserResource($request->user());
});

// Auth Routes
Route::post('login', [App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
// Route::middleware('guest')->group(function(){
// });

Route::middleware('auth:sanctum')->group(function () {
    // Route::group(['middleware' => ['role:admin']], function () {
    // });

    Route::apiResources([ 'users' => App\Http\Controllers\Api\UsersController::class, ]);
    Route::apiResources([ 'services' => App\Http\Controllers\Api\ServicesController::class, ]);
    Route::apiResources([ 'bookings' => App\Http\Controllers\Api\BookingsController::class, ]);

    Route::post('logout', [App\Http\Controllers\Api\Auth\AuthController::class, 'logout']);
});
