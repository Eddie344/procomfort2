<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_id', 'diller_id', 'product_type', 'prefix', 'payment_type_id',
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

    public function paymentType()
    {
        return $this->belongsTo('App\Models\PaymentType', 'payment_type_id', 'id');
    }

    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('d.m.Y H:i');
    }

    public function scopeFilter($query)
    {
        if(request('deleted'))
        {
            $query->onlyTrashed();
        }
        return $query;
    }
}
