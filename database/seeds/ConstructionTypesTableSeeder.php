<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConstructionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('construction_types')->insert([
            [
                'label' => 'Mini',
                'product_type_id' => '1',
            ],
            [
                'label' => 'UNI-1',
                'product_type_id' => '1',
            ],
            [
                'label' => 'UNI-2',
                'product_type_id' => '1',
            ],
            [
                'label' => 'D-25',
                'product_type_id' => '1',
            ],
            [
                'label' => 'D-35',
                'product_type_id' => '1',
            ],

            [
                'label' => 'Mini',
                'product_type_id' => '2',
            ],
            [
                'label' => 'UNI-1',
                'product_type_id' => '2',
            ],
            [
                'label' => 'UNI-2',
                'product_type_id' => '2',
            ],
            [
                'label' => 'MGS',
                'product_type_id' => '2',
            ],
        ]);
    }
}
