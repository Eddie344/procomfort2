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
            ['label' => 'Ткань рулонная'],
            ['label' => 'Ткань день-ночь'],
            ['label' => 'Ткань вертикальная'],
            ['label' => 'Лента горизонтальная'],
            ['label' => 'Метал'],
            ['label' => 'Фурнитура'],
        ]);
    }
}
