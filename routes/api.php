<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::prefix('v1')->group(function () {
    Route::controller(\App\Http\Controllers\Auth\AuthController::class)
        ->prefix('/login')
        ->group(
            function () {
                Route::post('users', 'login');
            }
        );
});

