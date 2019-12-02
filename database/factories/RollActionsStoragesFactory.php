<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\RollActionsStorage;
use Faker\Generator as Faker;

$factory->define(RollActionsStorage::class, function (Faker $faker) {
    return [
        'roll_storage_id' => 1,
        'type_id' => 1,
        'user_id' => 1,
        'reason' => $faker->text(12),
        'width' => $faker->randomFloat(2,0, 2),
        'lenght' => $faker->randomFloat(2, 0, 2),
    ];
});
