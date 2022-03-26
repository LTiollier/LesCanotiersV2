<?php

namespace Database\Seeders;

use App\Models\Vegetable;
use Illuminate\Database\Seeder;

class VegetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $vegetables = [
            'Aubergine',
            'Betterave',
            'Brocoli',
            'Chou-fleur',
            'Courgette',
            'Carotte',
            'Céleri',
            'Pomme de terre',
            'Batavia',
            'Topinambour',
            'Endive',
            'Oignon',
            'Poireau',
            'Epinard',
            'Fenouil',
        ];

        $vegetableCategories = \App\Models\VegetableCategory::all();

        foreach ($vegetables as $vegetable) {
            Vegetable::factory([
                'name' => $vegetable,
                'vegetable_category_id' => $vegetableCategories->random()->getKey(),
            ])->create();
        }
    }
}
