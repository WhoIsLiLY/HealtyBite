<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addons')->insert([
            ['name' => 'Extra Cheese', 'type' => 'extra', 'price' => 10000, 'menu_id' => 1, 'isAvailable' => 1],
            ['name' => 'Wasabi', 'type' => 'extra', 'price' => 5000, 'menu_id' => 2, 'isAvailable' => 1],
        ]);
    }
}
