<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZebraConstructionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zebra_constructions')->insert([
            ['label' => 'Mini'],
            ['label' => 'UNI-1'],
            ['label' => 'UNI-2'],
            ['label' => 'MGS'],
        ]);
    }
}
