<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoragesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('storages')->insert([
            [
                'label' => 'Ткани рулонные',
                'route' => 'roll'
            ],
            [
                'label' => 'Ткани день-ночь',
                'route' => 'zebra'
            ],
            [
                'label' => 'Ткани вертикальные',
                'route' => 'vert'
            ],
            [
                'label' => 'Лента горизонтальная',
                'route' => 'goriz'
            ],
            [
                'label' => 'Метал',
                'route' => 'metal'
            ],
            [
                'label' => 'Фурнитура',
                'route' => 'furn'
            ],
        ]);
    }
}
