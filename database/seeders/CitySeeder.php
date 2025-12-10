<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run()
    {
        City::insert([
    ['name' => 'Vilnius', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Kaunas', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Klaipėda', 'created_at' => now(), 'updated_at' => now()],
]);

      
    }
}

