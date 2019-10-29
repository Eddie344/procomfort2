<?php


namespace App\Http\ViewComposers;

use App\Models\RollCategory;
use App\Models\ZebraCategory;
use Illuminate\View\View;

class CategoryComposer
{
    public $roll_categories = [];
    public $zebra_categories = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->roll_categories = RollCategory::all();
        $this->zebra_categories = ZebraCategory::all();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with(['roll_categories' =>  $this->roll_categories, 'zebra_categories' => $this->zebra_categories]);
    }
}
