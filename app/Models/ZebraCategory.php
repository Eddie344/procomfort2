<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZebraCategory extends Model
{
    public function storage()
    {
        return $this->morphMany('App\Models\Storage', 'categoriable');
    }
}
