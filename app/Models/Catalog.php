<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $fillable = [
        'label'
    ];

    public function rollStorage()
    {
        return $this->hasMany('App\Models\RollStorage');
    }
}
