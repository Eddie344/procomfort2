<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RollStorage extends Model
{
    protected $fillable = [
        'label', 'catalog_id', 'category_id', 'picture_id'
    ];

    public function catalog()
    {
        return $this->belongsTo('App\Models\Catalog', 'catalog_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\RollCategory', 'category_id', 'id');
    }

    public function picture()
    {
        return $this->belongsTo('App\Models\RollPicture', 'picture_id', 'id');
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
        if(request('picture'))
        {
            $query->where('picture_id', request('picture'));
        }
        return $query;
    }
}
