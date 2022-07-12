<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VegetableCategoryController;
use App\Http\Controllers\VegetableController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'create')->name('login');

    Route::post('/login', 'store');

    Route::post('/logout', 'logout')
        ->middleware('auth')
        ->name('logout');
});

Route::resources([
    'times' => TimeController::class,
    'activities' => ActivityController::class,
    'cycles' => CycleController::class,
    'parcels' => ParcelController::class,
    'vegetables' => VegetableController::class,
    'vegetableCategories' => VegetableCategoryController::class,
    'users' => UserController::class,
], [
    'except' => ['show'],
    'middleware' => ['auth'],
]);
