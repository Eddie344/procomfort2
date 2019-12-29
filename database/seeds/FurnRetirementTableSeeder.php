<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FurnRetirementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('furn_retirements')->insert([
            //Roll mini
            [
                'type_id' => '1',
                'construction_id' => '1',
                'label' => 'Цепочка',
            ],
            [
                'type_id' => '1',
                'construction_id' => '1',
                'label' => 'Ручка',
            ],
            [
                'type_id' => '1',
                'construction_id' => '1',
                'label' => 'Механизм',
            ],
        ]);
    }
}
