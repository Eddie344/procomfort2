<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZebraPrice extends Model
{
    protected $casts = [
//        'width' => 'string',
//        'height' => 'string',
        'price' => 'string',
    ];

    protected $guarded = [];

    public $timestamps = false;
    public function scopeFilter($query)
    {
        if(request('construction_id'))
        {
            $query->where('construction_id', request('construction_id'));
        }
        if(request('catalog_id'))
        {
            $query->where('catalog_id', request('catalog_id'));
        }
        if(request('category_id'))
        {
            $query->where('category_id', request('category_id'));
        }
        return $query;
    }
}
