<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            ProvidersTableSeeder::class,
            CatalogsTableSeeder::class,
            RollPicturesTableSeeder::class,
            StoragesTableSeeder::class,
            OrderStatusesTableSeeder::class,
            ProductTypesTableSeeder::class,
            ConstructionTypesTableSeeder::class,
            ComplectationTypesTableSeeder::class,
            FurnColorsTableSeeder::class,
            MeasurementTypesTableSeeder::class,
            MountTypesTableSeeder::class,
            ProductRuleTypesTableSeeder::class,
            PaymentTypesTableSeeder::class,
            StoragesTypesTableSeeder::class,
            PartStatusesTableSeeder::class,
            PartTypesTableSeeder::class,
            ActionTypesTableSeeder::class,
            RollCategoryTableSeeder::class,
            RollStorageTableSeeder::class,
            //RollActionStoregeTableSeeder::class,
        ]);
    }
}
