<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GorizPrice extends Model
{
    protected $casts = [
        'price' => 'string',
    ];

    protected $guarded = [];

    public $timestamps = false;

    public function scopeFilter($query)
    {
        if(request('catalog_id'))
        {
            $query->where('catalog_id', request('catalog_id'));
        }
        return $query;
    }
}
