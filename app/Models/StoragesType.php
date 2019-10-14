<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoragesType extends Model
{
    public function storage()
    {
        return $this->hasMany('App\Models\Storage');
    }
}
