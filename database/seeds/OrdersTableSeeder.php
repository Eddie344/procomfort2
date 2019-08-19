<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'creator_id' => '2',
                'customer_id' => '2',
                'order_name' => '126П',
                'status' => '2',
            ],
            [
                'creator_id' => '2',
                'customer_id' => '2',
                'order_name' => '127П',
                'status' => '1',
            ],
            [
                'creator_id' => '1',
                'customer_id' => NULL,
                'order_name' => 'Гена',
                'status' => '3',
            ],
        ]);
    }
}
