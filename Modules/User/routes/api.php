<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::middleware('auth:users')->prefix('v1')->group(function () {
    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::post('create', 'createUser');
        Route::put('update/{user}', 'updateUser');
        Route::get('list', 'userList');
        Route::get('/{user}', 'getUser');
        Route::delete('/{user}', 'deleteUser');
    });
});
