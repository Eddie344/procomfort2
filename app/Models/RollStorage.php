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
        if(request('catalog_id'))
        {
            $query->where('catalog_id', request('catalog_id'));
        }
        if(request('category_id'))
        {
            $query->where('category_id', request('category_id'));
        }
        if(request('picture_id'))
        {
            $query->where('picture_id', request('picture_id'));
        }
        return $query;
    }
}
