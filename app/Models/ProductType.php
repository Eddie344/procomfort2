<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }
}
