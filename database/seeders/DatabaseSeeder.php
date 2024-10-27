<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        
        $this->call(CountrySeeder::class);
        $this->call(CitySeeder::class);

        $this->call(CategoryBlueprintSeeder::class);
        $this->call(ProductBlueprintSeeder::class);
        $this->call(AdditionBlueprintSeeder::class);

        
        $this->call(CompanySeeder::class);
        $this->call(ShopSeeder::class);
        
        $this->call(ShopSeeder::class);
        

    }
}
