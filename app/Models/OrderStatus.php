<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }
}
