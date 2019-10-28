<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetalPartsStorage extends Model
{
    protected $fillable = [
        'status_id', 'lenght', 'price', 'provider_id', 'metal_storage_id'
    ];

    public function metalStorage()
    {
        return $this->belongsTo('App\Models\MetalStorage', 'metal_storage_id');
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
