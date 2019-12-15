<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('action_types')->insert([
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
