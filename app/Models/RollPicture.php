<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RollPicture extends Model
{
    public function storage()
    {
        return $this->hasMany('App\Models\RollStorage');
    }
}
