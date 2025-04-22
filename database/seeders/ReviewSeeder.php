<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            ['customers_id' => 1, 'restaurants_id' => 1, 'title' => 'Best Food', 'comment' => 'Great food!', 'rating' => 5],
        ]);
    }
}
