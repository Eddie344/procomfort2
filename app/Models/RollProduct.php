<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RollProduct extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\ProductType', 'type_id');
    }

    public function construction()
    {
        return $this->belongsTo('App\Models\ConstructionType', 'construction_id');
    }

    public function rule()
    {
        return $this->belongsTo('App\Models\ProductRuleType', 'rule_type_id');
    }

    public function material()
    {
        return $this->belongsTo('App\Models\RollStorage', 'material_id');
    }

    public function complectation()
    {
        return $this->belongsTo('App\Models\ComplectationType', 'complectation_type_id');
    }

    public function measurement()
    {
        return $this->belongsTo('App\Models\MeasurementType', 'measurement_type_id');
    }

    public function mount()
    {
        return $this->belongsTo('App\Models\MountType', 'mount_type_id');
    }
    public function furnColor()
    {
        return $this->belongsTo('App\Models\FurnColor', 'furn_color_id');
    }
}
