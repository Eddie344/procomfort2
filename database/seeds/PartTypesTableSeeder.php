<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('part_types')->insert([
            [
                'label' => 'Рулон',
            ],
            [
                'label' => 'Фрагмент',
            ]
        ]);
    }
}
