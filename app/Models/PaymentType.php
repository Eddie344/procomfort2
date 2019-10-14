<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }
}
