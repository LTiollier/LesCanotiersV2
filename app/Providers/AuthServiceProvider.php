<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Time;
use App\Policies\ActivityPolicy;
use App\Policies\TimePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Time::class => TimePolicy::class,
        Activity::class => ActivityPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
