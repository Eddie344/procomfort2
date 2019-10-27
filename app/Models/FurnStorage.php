<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FurnStorage extends Model
{
    protected $fillable = [
        'label', 'unit',
    ];

    public function scopeFilter($query)
    {
        if(request('label'))
        {
            $query->where('label', 'LIKE', '%'.request('label').'%');
        }
        if(request('unit'))
        {
            $query->where('unit', request('unit'));
        }
        return $query;
    }

}
