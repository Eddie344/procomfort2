<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FurnPartsStorage extends Model
{
    protected $fillable = [
        'status_id', 'count', 'price', 'provider_id', 'furn_storage_id'
    ];

    public function furnStorage()
    {
        return $this->belongsTo('App\Models\FurnStorage', 'furn_storage_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\PartStatus', 'status_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\PartType', 'type_id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }
}
