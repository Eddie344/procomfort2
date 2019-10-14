<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasurementTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('measurement_types')->insert([
            ['label' => 'По габариту',],
            ['label' => 'По окну',],
            ['label' => 'По ткани',],
        ]);
    }
}
