<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartStatus extends Model
{
    public function rollParts()
    {
        return $this->hasMany('App\Models\RollPartsStorage');
    }

    public function zebraParts()
    {
        return $this->hasMany('App\Models\ZebraPartsStorage');
    }
}
