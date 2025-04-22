<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            ['name' => 'Vegan Cheeseburger', 'price' => 50000, 'restaurants_id' => 2, 'description' => 'burger', 'isAvailable' => 1, 'calorie' => 450, 'nutrition_facts' => 'Protein 25g', 'menu_image' => 'burger.jpg'],
            ['name' => 'Salmon Sushi', 'price' => 80000, 'restaurants_id' => 1, 'description' => 'sushi', 'isAvailable' => 1, 'calorie' => 300, 'nutrition_facts' => 'Protein 20g', 'menu_image' => 'sushi.jpg'],
        ]);
    }
}
