<?php

namespace Database\Seeders;

use App\Models\CategoryBlueprint;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryBlueprintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryBlueprint::create(
            ['name' => 'Rostilj'],
        );
        CategoryBlueprint::create(
            ['name' => 'Pizza'],
        );
        CategoryBlueprint::create(
            ['name' => 'Drinks'],
        );
    }
}
