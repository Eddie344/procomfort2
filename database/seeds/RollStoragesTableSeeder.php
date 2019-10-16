<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollStoragesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roll_storages')->insert([
            [
                'label' => 'L-0800',
                'catalog_id' => '1',
                'category_id' => '1',
            ],
            [
                'label' => 'L-0564',
                'catalog_id' => '2',
                'category_id' => '3',
            ],
        ]);
    }
}
