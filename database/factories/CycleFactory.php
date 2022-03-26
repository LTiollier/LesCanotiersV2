<?php

namespace Database\Factories;

use App\Models\Cycle;
use App\Models\Parcel;
use App\Models\Vegetable;
use Illuminate\Database\Eloquent\Factories\Factory;

class CycleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cycle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'starts_at' => $this->faker->date(),
            'ends_at' => $this->faker->date(),
            'vegetable_id' => Vegetable::factory(),
            'parcel_id' => Parcel::factory(),
        ];
    }
}
