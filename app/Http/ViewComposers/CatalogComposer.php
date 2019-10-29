<?php


namespace App\Http\ViewComposers;

use App\Models\Catalog;
use Illuminate\View\View;

class CatalogComposer
{
    public $catalogs = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->catalogs = Catalog::all();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('catalogs', $this->catalogs);
    }
}
