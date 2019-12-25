<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roll_categories')->insert([
            ['label' => '1', 'catalog_id' => '1'],
            ['label' => '2', 'catalog_id' => '1'],
        ]);
    }
}
