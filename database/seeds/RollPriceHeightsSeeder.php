<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollPriceHeightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roll_price_heights')->insert([
            ['height' => '1.7'],
            ['height' => '2.0'],
            ['height' => '2.3'],
            ['height' => '2.5'],
        ]);
    }
}
