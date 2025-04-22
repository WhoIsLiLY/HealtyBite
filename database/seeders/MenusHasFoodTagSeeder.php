<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusHasFoodTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus_has_food_tags')->insert([
            ['menus_id' => 1, 'food_tags_id' => 1],
            ['menus_id' => 2, 'food_tags_id' => 3],
        ]);
    }
}
