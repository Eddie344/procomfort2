<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GorizCategory extends Model
{
    public function storage()
    {
        return $this->morphMany('App\Models\Storage', 'categoriable');
    }
}
