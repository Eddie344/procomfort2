<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GorizStorage extends Model
{
    protected $fillable = [
        'label', 'catalog_id', 'category_id'
    ];

    public function catalog()
    {
        return $this->belongsTo('App\Models\Catalog', 'catalog_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\GorizCategory', 'category_id', 'id');
    }

    public function scopeFilter($query)
    {
        if(request('label'))
        {
            $query->where('label', 'LIKE', '%'.request('label').'%');
        }
        if(request('catalog'))
        {
            $query->where('catalog_id', request('catalog'));
        }
        if(request('category'))
        {
            $query->where('category_id', request('category'));
        }
        return $query;
    }
}
