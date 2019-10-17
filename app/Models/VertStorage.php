<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VertStorage extends Model
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
        return $this->belongsTo('App\Models\VertCategory', 'category_id', 'id');
    }
}
