<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('part_statuses')->insert([
            [
                'label' => 'В работе',
                'color' => 'primary',
            ],
            [
                'label' => 'Фрагмент',
                'color' => 'secondary',
            ],
            [
                'label' => 'Ожидание',
                'color' => 'warning',
            ]
        ]);
    }
}
