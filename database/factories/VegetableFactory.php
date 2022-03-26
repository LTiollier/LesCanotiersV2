<?php

namespace Database\Factories;

use App\Models\Vegetable;
use App\Models\VegetableCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class VegetableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vegetable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,
            'vegetable_category_id' => VegetableCategory::factory(),
        ];
    }
}
