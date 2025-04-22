<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            'customers_id' => 1,
                'restaurants_id' => 1,
                'payment_methods_id' => 1,
                'total_price' => 150000,
                'order_type' => 'Dine-in',
                'status' => 'Completed',
                'notes' => 'No wasabi',
                'created_at' => Carbon::now()]
        );
    }
}
