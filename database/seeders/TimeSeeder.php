<?php

namespace Database\Seeders;

use App\Models\Time;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    public function run(): void
    {
        Time::factory()->create([
            'id' => 1,
            'cycle_id' => 1,
            'activity_id' => 1,
            'user_id' => 1,
        ]);

        Time::factory()->create([
            'id' => 2,
            'cycle_id' => 2,
            'activity_id' => 2,
            'user_id' => 2,
        ]);
    }
}
