<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StorageActionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('storage_action_types')->insert([
            [
                'label' => 'Пополнение',
                'color' => 'success'
            ],
            [
                'label' => 'Списание',
                'color' => 'danger'
            ],
        ]);
    }
}
