<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VertPartsStorage extends Model
{
    protected $fillable = [
        'status_id', 'lenght', 'price', 'provider_id', 'vert_storage_id'
    ];

    public function vertStorage()
    {
        return $this->belongsTo('App\Models\VertStorage', 'vert_storage_id');
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
