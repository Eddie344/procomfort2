<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetalRetirementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metal_retirements')->insert([
            //Roll mini
            [
                'type_id' => '1',
                'construction_id' => '1',
                'label' => 'Направляющие',
                'depends' => 'Height',
                'dependsCount' => '+0',
                'count' => '2',
            ],
            [
                'type_id' => '1',
                'construction_id' => '1',
                'label' => 'Труба',
                'depends' => 'Width',
                'dependsCount' => '+0',
                'count' => '1',
            ],
            [
                'type_id' => '1',
                'construction_id' => '1',
                'label' => 'Отвес',
                'depends' => 'Width',
                'dependsCount' => '+0',
                'count' => '1',
            ],
        ]);
    }
}
