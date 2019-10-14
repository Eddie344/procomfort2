<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplectationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('complectation_types')->insert([
            ['label' => 'Целое изделие',],
            ['label' => 'Только карниз',],
            ['label' => 'Только ткань',],
        ]);
    }
}
