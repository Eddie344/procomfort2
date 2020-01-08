<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FurnRetirement extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'furn_id'
    ];

    public function furn()
    {
        return $this->belongsTo('App\Models\FurnStorage', 'furn_id', 'id');
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
