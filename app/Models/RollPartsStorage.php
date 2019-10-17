<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RollPartsStorage extends Model
{
    public function status()
    {
        return $this->belongsTo('App\Models\PartStatus', 'part_status_id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }
}
