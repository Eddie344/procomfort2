<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RollCategory extends Model
{
    protected $fillable = [
        'label', 'catalog_id'
    ];

    public function storage()
    {
        return $this->hasMany('App\Models\RollStorage');
    }

    public function scopeFilter($query)
    {
        if(request('catalog_id'))
        {
            $query->where('catalog_id', request('catalog_id'));
        }
        return $query;
    }
}
