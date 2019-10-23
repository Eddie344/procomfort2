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
            RollCategoriesTableSeeder::class,
            ZebraCategoriesTableSeeder::class,
            VertCategoriesTableSeeder::class,
            GorizCategoriesTableSeeder::class,
            StoragesTableSeeder::class,
            RollStoragesTableSeeder::class,
            OrderStatusesTableSeeder::class,
            ProductTypesTableSeeder::class,
            ComplectationTypesTableSeeder::class,
            FurnColorsTableSeeder::class,
            MeasurementTypesTableSeeder::class,
            MountTypesTableSeeder::class,
            ProductRuleTypesTableSeeder::class,
            PaymentTypesTableSeeder::class,
            OrdersTableSeeder::class,
            StoragesTypesTableSeeder::class,
            PartStatusesTableSeeder::class,
            PartTypesTableSeeder::class,
            RollPartsStoragesTableSeeder::class,
            StorageActionTypesTableSeeder::class,
            RollActionsStoragesTableSeeder::class,
        ]);
    }
}
