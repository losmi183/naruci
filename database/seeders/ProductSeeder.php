<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Pljeskavica',
            'grams' => 200,
            'price' => 300,
            'category_id' => 1,
            'company_id' => 1
        ]);
        Product::create([
            'name' => 'Gurmanska pljeskavica',
            'grams' => 250,
            'price' => 350,
            'category_id' => 1,
            'company_id' => 1
        ]);
        Product::create([
            'name' => 'Pileci file',
            'grams' => 250,
            'price' => 350,
            'category_id' => 1,
            'company_id' => 1
        ]);
        Product::create([
            'name' => 'Pileci batak',
            'grams' => 250,
            'price' => 350,
            'category_id' => 1,
            'company_id' => 1
        ]);
        Product::create([
            'name' => 'Pljeskavica',
            'grams' => 200,
            'price' => 300,
            'category_id' => 1,
            'company_id' => 2
        ]);
        Product::create([
            'name' => 'Gurmanska pljeskavica',
            'grams' => 250,
            'price' => 350,
            'category_id' => 1,
            'company_id' => 2
        ]);
        Product::create([
            'name' => 'Pileci file',
            'grams' => 250,
            'price' => 350,
            'category_id' => 1,
            'company_id' => 2
        ]);
        Product::create([
            'name' => 'Pileci batak',
            'grams' => 250,
            'price' => 350,
            'category_id' => 1,
            'company_id' => 2
        ]);
        Product::create([
            'name' => 'Pljeskavica',
            'grams' => 200,
            'price' => 300,
            'category_id' => 1,
            'company_id' => 3
        ]);
        Product::create([
            'name' => 'Gurmanska pljeskavica',
            'grams' => 250,
            'price' => 350,
            'category_id' => 1,
            'company_id' => 3
        ]);
        Product::create([
            'name' => 'Pileci file',
            'grams' => 250,
            'price' => 350,
            'category_id' => 1,
            'company_id' => 3
        ]);
        Product::create([
            'name' => 'Pileci batak',
            'grams' => 250,
            'price' => 350,
            'category_id' => 1,
            'company_id' => 3
        ]);
    }
}
