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
Route::post('register', [App\Http\Controllers\Api\Auth\AuthController::class, 'register']);
// Route::middleware('guest')->group(function(){
// });
Route::get('bookings/{booking}/getPaymentIntent', [App\Http\Controllers\Api\BookingPaymentController::class, 'getPaymentIntent']);
Route::get('bookings/submitPaymentSuccess', [App\Http\Controllers\Api\BookingPaymentController::class, 'submitPaymentSuccess']);

Route::middleware('auth:sanctum')->group(function () {
    // Route::group(['middleware' => ['role:admin']], function () {
    // });

    Route::apiResource('users', App\Http\Controllers\Api\UsersController::class);
    Route::apiResource('services', App\Http\Controllers\Api\ServicesController::class);
    Route::apiResource('bookings', App\Http\Controllers\Api\BookingsController::class);
    Route::apiResource('promocodes', App\Http\Controllers\Api\PromocodesController::class);

    Route::post('logout', [App\Http\Controllers\Api\Auth\AuthController::class, 'logout']);
});

Route::get('servers/{user}/availableTimes', App\Http\Controllers\Api\GetAvailableTimesController::class);
