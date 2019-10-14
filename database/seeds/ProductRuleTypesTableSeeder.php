<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductRuleTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_rule_types')->insert([
            ['label' => 'Правое',],
            ['label' => 'Левое',],
            ['label' => 'Двойное',],
        ]);
    }
}
