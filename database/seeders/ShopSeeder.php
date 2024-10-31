<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shop::create([
            'name' => 'Stepin Vajat Vozdovac',
            'company_id' => 1,
            'address' => 'Vojvode Stepe 1',
            'city_id' => 1,
        ]);
        Shop::create([
            'name' => 'Stepin Vajat Pancevo',
            'company_id' => 1,
            'address' => 'Oslobodjenja 1',
            'city_id' => 2,
        ]);
        Shop::create([
            'name' => 'Stepin Vajat NBG',
            'company_id' => 1,
            'address' => 'Jurija Gagarina',
            'city_id' => 2,
        ]);

        Shop::create([
            'name' => 'Toma leskovcanin',
            'company_id' => 2,
            'address' => 'Jna 10',
            'city_id' => 2,
        ]);

        Shop::create([
            'name' => 'Leskovac online Beograd',
            'company_id' => 3,
            'address' => 'Kraljice Petra 1',
            'city_id' => 1,
        ]);
        Shop::create([
            'name' => 'Leskovac online Pancevo',
            'company_id' => 3,
            'address' => 'Jna 1',
            'city_id' => 2,
        ]);
        Shop::create([
            'name' => 'Leskovac online Novi Sad',
            'company_id' => 3,
            'address' => 'Kisacka 1',
            'city_id' => 3,
        ]);
    }
}
