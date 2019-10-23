<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RollPartsStorage extends Model
{
    protected $fillable = [
        'status_id', 'width', 'lenght', 'price', 'provider_id', 'roll_storage_id'
    ];

    public function rollStorage()
    {
        return $this->belongsTo('App\Models\RollStorage', 'roll_storage_id');
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
