<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            ['admin.prices.roll.index'],
            'App\Http\ViewComposers\ConstructionComposer'
        );
        view()->composer(
            ['admin.prices.roll.index'],
            'App\Http\ViewComposers\CatalogComposer'
        );
        view()->composer(
            ['admin.prices.roll.index'],
            'App\Http\ViewComposers\CategoryComposer'
        );
    }
}
