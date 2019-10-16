<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RollCategory extends Model
{
    public function storage()
    {
        return $this->hasMany('App\Models\RollStorage');
    }
}
