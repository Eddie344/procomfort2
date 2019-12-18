<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConstructionType extends Model
{
    public function product_types()
    {
        return $this->belongsTo('ProductType');
    }

    public function scopeFilter($query)
    {
        if(request('product_type_id'))
        {
            $query->where('product_type_id', '=', request('product_type_id'));
        }
        return $query;
    }
}
