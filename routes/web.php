<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\TimeController;
use Illuminate\Support\Facades\Route;

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'create')->name('login');

    Route::post('/login', 'store');

    Route::post('/logout', 'logout')
        ->middleware('auth')
        ->name('logout')
    ;
});

Route::resources([
    'times' => TimeController::class,
    'activities' => ActivityController::class,
    'cycles' => CycleController::class,
], [
    'except' => ['show'],
    'middleware' => ['auth'],
]);
