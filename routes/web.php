<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'create')->name('login');

    Route::post('/login', 'store');

    Route::post('/logout', 'logout')
        ->middleware('auth')
        ->name('logout')
    ;
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        dd('coucou');
    });
});
