<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollPriceWidthsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roll_price_widths')->insert([
            ['width' => '0.5'],
            ['width' => '0.6'],
            ['width' => '0.7'],
            ['width' => '0.8'],
            ['width' => '0.9'],
            ['width' => '1.0'],
            ['width' => '1.1'],
            ['width' => '1.2'],
            ['width' => '1.3'],
            ['width' => '1.4'],
            ['width' => '1.5'],
        ]);
    }
}
