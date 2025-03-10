<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('foods')->insert([
            [
                'name' => 'Nasi Merah dengan Ayam Panggang Kecap & Tumis Kangkung',
                'nutrition_fact' => 'Kalori: 400-550 kkal
                Protein: 30-40 gram
                Lemak: 15-25 gram
                Karbohidrat: 50-70 gram
                Serat: 5-8 gram',
                'description' => 'Nikmati hidangan sehat dan lezat
                dengan Nasi Merah yang kaya serat, dipadukan dengan Ayam Panggang',
                'price' => 35000,
                "category_id" => 1
            ],
            [
                'name' => 'Nasi Hitam dan Tumis Ca Kailan',
                'nutrition_fact' => 'Kalori: 400-550 kkal
                Protein: 30-40 gram
                Lemak: 15-25 gram
                Karbohidrat: 50-70 gram
                Serat: 5-8 gram',
                'description' => 'Nikmati hidangan sehat dan lezat
                dengan Nasi Hitam yang kaya serat.',
                'price' => 30000,
                "category_id" => 2
            ],
        ]);
    }
}
