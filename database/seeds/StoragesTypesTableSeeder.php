<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoragesTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('storages_types')->insert([
            [
                'label' => 'Ткань рулонная',
                'category_table' => 'RollCategory',
            ],
            [
                'label' => 'Ткань день-ночь',
                'category_table' => 'ZebraCategory',
            ],
            [
                'label' => 'Ткань вертикальная',
                'category_table' => 'VertCategory',
            ],
            [
                'label' => 'Лента горизонтальная',
                'category_table' => 'GorizCategory',
            ],
            [
                'label' => 'Метал',
                'category_table' => '',
            ],
            [
                'label' => 'Фурнитура',
                'category_table' => '',
            ],
        ]);
    }
}
