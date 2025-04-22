<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            ['name' => 'John Doe', 'email' => 'customer@example.com', 'password' => Hash::make('123'), 'balance' => 150000, 'card_number' => '1234-5678-9012-3456', 'phone_number' => '08123456789', 'point' => 50],
        ]);
    }
}
