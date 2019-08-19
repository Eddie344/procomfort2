<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Эдуард',
                'surname' => 'Баженов',
                'email' => 'keep_calm@inbox.ru',
                'password' => bcrypt('123456789'),
                'role_id' => '2',
                'is_admin' => true,
            ],
        ]);
        DB::table('users')->insert([
            [
                'name' => 'Коля',
                'surname' => 'Николаев',
                'email' => 'kolya@inbox.ru',
                'password' => bcrypt('123456789'),
            ],
        ]);
    }
}
