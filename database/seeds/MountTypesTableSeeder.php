<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MountTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mount_types')->insert([
            ['label' => 'Потолок',],
            ['label' => 'Стена',],
            ['label' => 'Армстронг',],
        ]);
    }
}
