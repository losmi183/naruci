<?php

namespace Database\Seeders;

use App\Models\AdditionBlueprint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdditionBlueprintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdditionBlueprint::create(
            [
                'name' => 'Kupus',
            ]
        );
        AdditionBlueprint::create(
            [
                'name' => 'Luk',
            ]
        );
        AdditionBlueprint::create(
            [
                'name' => 'Urnebes',
            ]
        );
        AdditionBlueprint::create(
            [
                'name' => 'Pavlaka',
            ]
        );
        AdditionBlueprint::create(
            [
                'name' => 'Tucana ljuta paprika',
            ]
        );
        AdditionBlueprint::create(
            [
                'name' => 'So',
            ]
        );
        AdditionBlueprint::create(
            [
                'name' => 'Biber',
            ]
        );
        AdditionBlueprint::create(
            [
                'name' => 'Vegeta',
            ]
        );

    }
}
