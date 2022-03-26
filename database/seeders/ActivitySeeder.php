<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = [
            'Retourner la terre',
            'Plantage des graînes',
            'Arrosage',
            'Récolte',
        ];

        foreach ($activities as $activity) {
            Activity::factory(['name' => $activity])->create();
        }
    }
}
