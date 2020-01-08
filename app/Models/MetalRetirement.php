<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetalRetirement extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'metal_id'
    ];

    public function metal()
    {
        return $this->belongsTo('App\Models\MetalStorage', 'metal_id', 'id');
    }
    public function scopeFilter($query)
    {
        if (request('type_id'))
        {
            $query->where('type_id', request('type_id'));
        }
        if(request('construction_id'))
        {
            $query->where('construction_id', request('construction_id'));
        }
        return $query;
    }
}
