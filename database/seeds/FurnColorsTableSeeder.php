<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FurnColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('furn_colors')->insert([
            ['label' => 'Коричневый',],
            ['label' => 'Красный',],
            ['label' => 'Черный',],
        ]);
    }
}
