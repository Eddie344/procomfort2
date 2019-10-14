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
                'creator_id' => '1',
                'diller_id' => '2',
                'prefix' => 'К201',
                'product_type' => '2',
                'status_id' => '4',
            ],
        ]);
        DB::table('orders')->insert([
            [
                'creator_id' => '2',
                'diller_id' => '2',
                'prefix' => 'D54',
                'product_type' => '4',
                'status_id' => '2',
            ],
        ]);
    }
}
