<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'label'
    ];

    public function rollParts()
    {
        return $this->hasMany('App\Models\RollPartsStorage');
    }

    public function zebraParts()
    {
        return $this->hasMany('App\Models\ZebraPartsStorage');
    }
}
