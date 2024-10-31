<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin'),
            'role_id' => config('business.roles.admin'),
        ]);
        User::create([
            'name' => 'Stepa',
            'email' => 'stepa@mail.com',
            'password' => bcrypt('stepa'),
            'role_id' => config('business.roles.owner'),
            'company_id' => 1
        ]);
        User::create([
            'name' => 'Toma',
            'email' => 'toma@mail.com',
            'password' => bcrypt('toma'),
            'role_id' => config('business.roles.owner'),
            'company_id' => 2
        ]);
    }
}
