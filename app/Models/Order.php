<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('d.m.Y H:i');
    }
}
