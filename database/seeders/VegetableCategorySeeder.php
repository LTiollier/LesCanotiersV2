<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VegetableCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $vegetableCategories = [
            'Les légumes fleurs',
            'Les légumes feuilles',
            'Les légumes fruits',
            'Les légumes à bulbe',
            'Les légumes tubercules',
            'Les légumes graines',
            'Les légumes racine',
            'Les légumes tiges',
            'Les fruits à noyau',
            'Les fruits à pépin',
            'Les baies et fruits rouges',
            'Les agrumes',
            'Les fruits à coque',
            'Les fruits exotiques',
        ];

        foreach ($vegetableCategories as $vegetableCategory) {
            \App\Models\VegetableCategory::factory(['name' => $vegetableCategory])->create();
        }
    }
}
