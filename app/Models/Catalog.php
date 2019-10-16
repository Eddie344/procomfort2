<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    public function rollStorage()
    {
        return $this->hasMany('App\Models\RollStorage');
    }
}
