<?php

use App\Models\RollActionsStorage;
use Illuminate\Database\Seeder;

class RollActionStoregeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(RollActionsStorage::class, 10000)->create();
    }
}
