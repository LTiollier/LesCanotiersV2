<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Cycle;
use App\Models\Time;
use App\Policies\ModelForAdminPolicy;
use App\Policies\TimePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Time::class => TimePolicy::class,
        Activity::class => ModelForAdminPolicy::class,
        Cycle::class => ModelForAdminPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
