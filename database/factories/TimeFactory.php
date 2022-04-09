<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Cycle;
use App\Models\Time;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Time::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date,
            'minutes' => $this->faker->numberBetween(20, 150),
            'quantity' => $this->faker->numberBetween(1, 5),
            'cycle_id' => Cycle::factory(),
            'activity_id' => Activity::factory(),
            'user_id' => User::factory(),
        ];
    }
}
