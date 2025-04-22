<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('list_orders')->insert([
            ['orders_id' => 1, 'menus_id' => 2,  'detail' => 'No wasabi', 'quantity' => 1, 'subtotal' => 80000],
            ['orders_id' => 1, 'menus_id' => 1, 'detail' => 'Extra cheese', 'quantity' => 1, 'subtotal' => 50000],
        ]);
    }
}
