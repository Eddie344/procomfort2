<?php


namespace App\Http\ViewComposers;

use App\Models\ConstructionType;
use App\Models\ZebraConstruction;
use Illuminate\View\View;

class ConstructionComposer
{
    public $roll_constructions = [];
    public $zebra_constructions = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->roll_constructions = ConstructionType::all();
        $this->zebra_constructions = ZebraConstruction::all();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with(['roll_constructions'=> $this->roll_constructions,
            'zebra_constructions'=> $this->zebra_constructions]);
    }
}
