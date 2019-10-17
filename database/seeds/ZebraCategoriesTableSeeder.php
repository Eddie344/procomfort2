<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZebraCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zebra_categories')->insert([
            ['label' => '1'],
            ['label' => '2'],
            ['label' => '3']
        ]);
    }
}
