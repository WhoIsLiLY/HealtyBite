<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('restaurant_categories')->insert([
            ['name' => 'Fast Food'],
            ['name' => 'Japanese'],
            ['name' => 'Chinese'],
            ['name' => 'Indonesian'],
            ['name' => 'Western'],
        ]);
    }
}
