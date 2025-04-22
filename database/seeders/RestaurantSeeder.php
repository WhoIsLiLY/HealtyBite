<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('restaurants')->insert([
            [
                'name' => 'Sushi Place',
                'location' => 'Tokyo Street',
                'restaurant_categories_id' => 2,
                'email' => 'sushi@example.com',
                'password' => Hash::make('123'), 
                'phone_number' => '081234567001',
            ],
            [
                'name' => 'Burger House',
                'location' => 'Downtown',
                'restaurant_categories_id' => 1,
                'email' => 'burger@example.com',
                'password' => Hash::make('123'), 
                'phone_number' => '081234567002',
            ],
        ]);
    }
}
