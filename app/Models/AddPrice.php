<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddPrice extends Model
{
    protected $casts = [
        'price' => 'string',
    ];

    protected $guarded = [];

    public $timestamps = false;
}
