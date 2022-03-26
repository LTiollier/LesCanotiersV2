<?php

namespace Database\Factories;

use App\Models\VegetableCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class VegetableCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VegetableCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,
        ];
    }
}
