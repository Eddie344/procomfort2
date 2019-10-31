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
                'width' => '0.5',
                'height' => '1',
                'price' => '8.5',
            ],
            [
                'construction_id' => '1',
                'catalog_id' => '1',
                'category_id' => '1',
                'width' => '0.6',
                'height' => '1',
                'price' => '9',
            ],
            [
                'construction_id' => '1',
                'catalog_id' => '1',
                'category_id' => '1',
                'width' => '0.7',
                'height' => '1',
                'price' => '9.5',
            ],
            [
                'construction_id' => '1',
                'catalog_id' => '1',
                'category_id' => '1',
                'width' => '0.8',
                'height' => '1',
                'price' => '10',
            ],
            //
            [
                'construction_id' => '1',
                'catalog_id' => '1',
                'category_id' => '1',
                'width' => '0.5',
                'height' => '2',
                'price' => '8.5',
            ],
            [
                'construction_id' => '1',
                'catalog_id' => '1',
                'category_id' => '1',
                'width' => '0.6',
                'height' => '2',
                'price' => '9',
            ],
            [
                'construction_id' => '1',
                'catalog_id' => '1',
                'category_id' => '1',
                'width' => '0.7',
                'height' => '2',
                'price' => '9.5',
            ],
            [
                'construction_id' => '1',
                'catalog_id' => '1',
                'category_id' => '1',
                'width' => '0.8',
                'height' => '2',
                'price' => '10',
            ],

        ]);
    }
}
