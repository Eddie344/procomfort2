<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalogs')->insert([
            ['label' => 'Амиго'],
            ['label' => 'Межароль'],
        ]);
    }
}
