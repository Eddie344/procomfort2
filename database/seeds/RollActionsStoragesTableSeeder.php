<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollActionsStoragesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roll_actions_storages')->insert([
            [
                'roll_storage_id' => '1',
                'type_id' => '1',
                'user_id' => '1',
                'reason' => 'Зачем-то',
                'width' => '1.6',
                'lenght' => '1.8',
            ],
            [
                'roll_storage_id' => '1',
                'type_id' => '2',
                'user_id' => '2',
                'reason' => 'Зачем-то еще',
                'width' => '1.9',
                'lenght' => '2.8',
            ],
        ]);
    }
}
