<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('business.roles') as $key => $value) {
            \App\Models\Role::create([
                'id' => $value,
                'name' => $key
            ]);
        }
    }
}
