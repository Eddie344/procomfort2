<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConstructionType extends Model
{
    public function product_types()
    {
        return $this->belongsTo('ProductType');
    }
}
