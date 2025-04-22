<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\FoodSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RestaurantCategorySeeder::class,
            RestaurantSeeder::class,
            MenuSeeder::class,
            AddonsSeeder::class,
            FoodTagSeeder::class,
            MenusHasFoodTagSeeder::class,
            CustomerSeeder::class,
            ReviewSeeder::class,
            PaymentSeeder::class,
            OrderSeeder::class,
            OrderListSeeder::class,
        ]);
    }
}
