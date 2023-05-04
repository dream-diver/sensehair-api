<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlannerCrudController;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('booking', 'BookingCrudController');

    Route::crud('career-application', 'CareerApplicationCrudController');
    Route::crud('promocode', 'PromocodeCrudController');
    Route::crud('service', 'ServiceCrudController');
    Route::crud('user', 'UserCrudController');
}); // this should be the absolute last line of this file

Route::group([
    'namespace'  => 'Backpack\PermissionManager\app\Http\Controllers',
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', backpack_middleware()],
], function () {
    Route::crud('permission', 'PermissionCrudController');
    Route::crud('role', 'RoleCrudController');
    // Route::crud('user', 'UserCrudController'); // removed and placed within the backpack/custom routes files
});


