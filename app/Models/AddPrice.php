<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddPrice extends Model
{
    protected $casts = [
        'price' => 'string',
    ];

    protected $guarded = [];

    public $timestamps = false;
}
