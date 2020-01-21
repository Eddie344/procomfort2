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
            ['label' => 'Черновик', 'color' => 'default'],
            ['label' => 'Ожидает проверку', 'color' => 'secondary'],
            ['label' => 'Приостановлен', 'color' => 'danger'],
            ['label' => 'В работе', 'color' => 'info'],
            ['label' => 'Готов', 'color' => 'primary'],
            ['label' => 'Ожидает отгрузку', 'color' => 'warning'],
            ['label' => 'Отгружен', 'color' => 'success'],
        ]);
    }
}
