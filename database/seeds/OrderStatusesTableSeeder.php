<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert([
            ['label' => 'Черновик', 'color' => 'table-default'],
            ['label' => 'Ожидает проверку', 'color' => 'table-secondary'],
            ['label' => 'Приостановлен', 'color' => 'table-danger'],
            ['label' => 'В работе', 'color' => 'table-info'],
            ['label' => 'Готов', 'color' => 'table-primary'],
            ['label' => 'Ожидает отгрузку', 'color' => 'table-warning'],
            ['label' => 'Отгружен', 'color' => 'table-success'],
        ]);
    }
}
