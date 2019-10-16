<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roll_categories')->insert([
            ['label' => '1'],
            ['label' => '2'],
            ['label' => '3']
        ]);
    }
}
