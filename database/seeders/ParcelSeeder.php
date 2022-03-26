<?php

namespace Database\Seeders;

use App\Models\Parcel;
use Illuminate\Database\Seeder;

class ParcelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $parcels = [
            'A1',
            'A1 Bis',
            'B2',
            'C4',
        ];

        foreach ($parcels as $parcel) {
            Parcel::factory(['name' => $parcel])->create();
        }
    }
}
