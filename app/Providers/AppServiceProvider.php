<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\ParallelTesting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot(): void
    {
        ParallelTesting::setUpTestDatabase(function ($database, $token) {
            Artisan::call('db:seed --class=TestDatabaseSeeder');
        });
    }
}
