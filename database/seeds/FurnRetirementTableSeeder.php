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
                'depends' => 'Height',
                'dependsCount' => '*2',
                'count' => '1',
            ],
            [
                'type_id' => '1',
                'construction_id' => '1',
                'label' => 'Ручка',
                'depends' => 'Count',
                'dependsCount' => '+0',
                'count' => '1',
            ],
            [
                'type_id' => '1',
                'construction_id' => '1',
                'label' => 'Механизм',
                'depends' => 'Count',
                'dependsCount' => '+0',
                'count' => '1',
            ],
        ]);
    }
}
