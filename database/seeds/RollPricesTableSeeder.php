<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roll_prices')->insert([
            [
                'construction_id' => '1',
                'catalog_id' => '1',
                'category_id' => '1',
                'width_id' => '1',
                'height_id' => '1',
                'price' => '8.5',
            ],
            [
                'construction_id' => '1',
                'catalog_id' => '1',
                'category_id' => '1',
                'width_id' => '2',
                'height_id' => '1',
                'price' => '9',
            ],
            [
                'construction_id' => '1',
                'catalog_id' => '1',
                'category_id' => '1',
                'width_id' => '3',
                'height_id' => '1',
                'price' => '9.5',
            ],
            [
                'construction_id' => '1',
                'catalog_id' => '1',
                'category_id' => '1',
                'width_id' => '4',
                'height_id' => '1',
                'price' => '10',
            ],

        ]);
    }
}
