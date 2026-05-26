<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::prefix('v1')->group(function () {
    Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
        Route::post('login/users', 'login');

        Route::middleware('auth:users')->group(function () {
            Route::get('login/me', 'me');
            Route::post('logout/users', 'logout');
        });
    });

    // TESTING ROUTES
    Route::controller(\App\Http\Controllers\OrdersController::class)
        ->prefix('/orders')
        ->group(
            function () {
                Route::post('create', 'create');
            }
        );
});

