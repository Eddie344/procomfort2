<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_id', 'diller_id', 'product_type', 'prefix',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType', 'product_type', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\OrderStatus', 'status_id', 'id');
    }
    public function diller()
    {
        return $this->belongsTo('App\Models\User', 'diller_id', 'id');
    }
}
