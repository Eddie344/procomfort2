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
            ],
            [
                'type_id' => '1',
                'construction_id' => '1',
                'label' => 'Труба',
            ],
            [
                'type_id' => '1',
                'construction_id' => '1',
                'label' => 'Отвес',
            ],
        ]);
    }
}
