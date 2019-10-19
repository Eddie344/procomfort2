<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RollPartsStorage extends Model
{
    protected $fillable = [
        'status_id', 'width', 'lenght', 'price', 'provider_id', 'roll_storage_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Models\PartStatus', 'status_id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }
}
