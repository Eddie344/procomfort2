<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollStorageTableSeeder extends Seeder
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
                'label' => 'L-0880',
                'catalog_id' => '1',
                'category_id' => '1',
                'picture_id' => '1',
            ]
        ]);
    }
}
