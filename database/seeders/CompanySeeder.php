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
            'name' => 'Stepin Vajat'
        ]);
        Company::create([
            'name' => 'Toma leskovcanin'
        ]);
        Company::create([
            'name' => 'Leskovac online'
        ]);
    }
}
