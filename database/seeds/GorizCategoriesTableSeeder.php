<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GorizCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goriz_categories')->insert([
            ['label' => '1'],
            ['label' => '2'],
            ['label' => '3']
        ]);
    }
}
