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
            ['label' => 'Рулонные шторы'],
            ['label' => 'День-ночь'],
            ['label' => 'Вертикальные жалюзи'],
            ['label' => 'Горизонтальные жалюзи'],
        ]);
    }
}
