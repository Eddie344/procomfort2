<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZebraPartsStorage extends Model
{
    protected $fillable = [
        'status_id', 'type_id', 'width', 'lenght', 'price', 'provider_id', 'zebra_storage_id'
    ];

    public function zebraStorage()
    {
        return $this->belongsTo('App\Models\ZebraStorage', 'zebra_storage_id');
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
