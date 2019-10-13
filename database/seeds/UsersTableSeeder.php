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
                'alias' => 'Эд',
                'email' => 'keep_calm@inbox.ru',
                'password' => bcrypt('123456789'),
                'phone' => '+375292652093',
                'city' => 'Минск',
                'balance' => '168',
                'role_id' => '2',
                'is_admin' => true,
            ],
        ]);
        DB::table('users')->insert([
            [
                'name' => 'Коля',
                'surname' => 'Николаев',
                'alias' => 'КН',
                'email' => 'kolya@inbox.ru',
                'password' => bcrypt('123456789'),
                'phone' => '+375296122160',
                'city' => 'Гродно',
                'balance' => '158',
            ],
        ]);
    }
}
