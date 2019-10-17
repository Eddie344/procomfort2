<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollPicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roll_pictures')->insert([
            ['label' => 'Горизонтальное'],
            ['label' => 'Вертикальное'],
            ['label' => 'Любое']
        ]);
    }
}
