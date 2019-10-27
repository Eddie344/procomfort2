<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetalStorage extends Model
{
    protected $fillable = [
        'label',
    ];

    public function scopeFilter($query)
    {
        if(request('label'))
        {
            $query->where('label', 'LIKE', '%'.request('label').'%');
        }
        return $query;
    }

}
