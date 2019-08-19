<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'order_id' => '1',
                'width' => '120',
                'height' => '230',
                'control' => 'Правое',
                'price' => '20',
            ],
            [
                'order_id' => '2',
                'width' => '140',
                'height' => '250',
                'control' => 'Левое',
                'price' => '40',
            ],
        ]);
    }
}
