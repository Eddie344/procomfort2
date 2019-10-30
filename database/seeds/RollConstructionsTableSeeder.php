<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollConstructionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roll_constructions')->insert([
            ['label' => 'Mini'],
            ['label' => 'UNI-1'],
            ['label' => 'UNI-2'],
            ['label' => 'D-25'],
            ['label' => 'D-35'],
        ]);
    }
}
