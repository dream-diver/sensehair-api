<?php

use App\Models\Booking;
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
// Route::get('/reset/password',function(){
//     return view('auth.reset_password');
// })->name('password.reset');

Route::view('forgot_password', 'auth.reset_password')->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Api\ForgotPasswordController::class, 'reset'])->name('confirm.reset');

// Route::get('/welcome', function () {
//     return view('welcome');
// });

Route::get('/reset/success', function () {
    return view('auth.reset_success');
});

Route::get('/mail', function () {
    $booking = Booking::first();
    return view('mail.notify', compact('booking'));
});

Route::get('/', function() {
    return redirect('admin');
});

Route::get('planner', 'App\Http\Controllers\PlannerCrudController@index')->name('planner');
