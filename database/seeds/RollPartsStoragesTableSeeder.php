<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollPartsStoragesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roll_parts_storages')->insert([
            [
                'roll_storage_id' => '1',
                'width' => '1.3',
                'lenght' => '25',
                'price' => '3.7',
                'provider_id' => '1',
                'status_id' => '1',
            ],
            [
                'roll_storage_id' => '1',
                'width' => '1.3',
                'lenght' => '2',
                'price' => '3.3',
                'provider_id' => '1',
                'status_id' => '2',
            ],
        ]);
    }
}
