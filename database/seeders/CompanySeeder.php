<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'Stepin Vajat',
            'description' => 'Rostilj na cumuru, tradicija kvalitet',
            'pib' => '123456789',
            'country_id' => 1,
            'city_id' => 1,
            'address' => 'Vojvode Stepe 1',
        ]);
        Company::create([
            'name' => 'Toma leskovcanin',
            'description' => 'Rostilj na cumuru, leskovacki recept',
            'pib' => '123456788',
            'country_id' => 1,
            'city_id' => 2,
            'address' => 'Mite topalovica 1',
        ]);
        Company::create([
            'name' => 'Leskovac online'
        ]);
    }
}
