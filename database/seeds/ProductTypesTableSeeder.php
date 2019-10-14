<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            ['label' => 'Рулонные MINI'],
            ['label' => 'Рулонные UNI-1'],
            ['label' => 'Рулонные UNI-2'],
            ['label' => 'Рулонные D-25'],
            ['label' => 'Рулонные D-35'],
            ['label' => 'День-ночь MINI'],
            ['label' => 'День-ночь UNI-1'],
            ['label' => 'День-ночь UNI-2'],
            ['label' => 'День-ночь MGS'],
            ['label' => 'Вертикальные'],
            ['label' => 'Горизонтальные'],
        ]);
    }
}
