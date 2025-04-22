<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('food_tags')->insert([
            ['name' => 'Spicy'],
            ['name' => 'Vegetarian'],
            ['name' => 'Gluten-Free'],
        ]);
    }
}
