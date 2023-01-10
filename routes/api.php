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
Route::post('auth/forget-password', [App\Http\Controllers\Api\ForgotPasswordController::class, 'forgot']);
// Route::middleware('guest')->group(function(){
// });

Route::post('guest/bookings', [App\Http\Controllers\Api\GuestBookingsController::class, 'store']);
Route::get('bookings/{booking}/getPaymentIntent', [App\Http\Controllers\Api\BookingPaymentController::class, 'getPaymentIntent']);
Route::get('bookings/submitPaymentSuccess', [App\Http\Controllers\Api\BookingPaymentController::class, 'submitPaymentSuccess']);
Route::get('getPromocodeFromCode/{code}', App\Http\Controllers\Api\PromocodeDetailsFromCodeController::class);

Route::apiResource('services', App\Http\Controllers\Api\ServicesController::class);
Route::apiResource('users', App\Http\Controllers\Api\UsersController::class);

Route::post('career/apply', [App\Http\Controllers\Api\CareerApplicationController::class, 'apply']);
Route::get('career/applications', [App\Http\Controllers\Api\CareerApplicationController::class, 'index']);
Route::get('career/applications/{id}', [App\Http\Controllers\Api\CareerApplicationController::class, 'show']);
Route::post('career/applications/{id}/delete', [App\Http\Controllers\Api\CareerApplicationController::class, 'delete']);

Route::post('/test/email', [App\Http\Controllers\Api\BookingsController::class, 'testMail']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('bookings', App\Http\Controllers\Api\BookingsController::class);
    Route::apiResource('promocodes', App\Http\Controllers\Api\PromocodesController::class);
    Route::post('bookings/cancel', [App\Http\Controllers\Api\BookingsController::class, 'cancel']);
    Route::post('logout', [App\Http\Controllers\Api\Auth\AuthController::class, 'logout']);
});

Route::get('servers/{user}/availableTimes', App\Http\Controllers\Api\GetAvailableTimesController::class);
