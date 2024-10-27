<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
            'name' => 'Beograd',
            'country_id' => 1
        ]);

        City::create([
            'name' => 'Pancevo',
            'country_id' => 1
        ]);

        City::create([
            'name' => 'Nis',
            'country_id' => 1
        ]);
        City::create([
            'name' => 'Novi sad',
            'country_id' => 1
        ]);
    }
}
