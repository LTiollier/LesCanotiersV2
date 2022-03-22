<?php

use Illuminate\Support\Facades\Route;

Route::get('/auth/login', function () {
    return \Inertia\Inertia::render('Auth/Login');
});
