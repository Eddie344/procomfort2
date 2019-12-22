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
        'creator_id', 'diller_id', 'prefix', 'product_type_id', 'construction_type_id', 'status_id', 'payment_type_id', 'admin_msg', 'diller_msg'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType', 'product_type_id', 'id');
    }

    public function constructionType()
    {
        return $this->belongsTo('App\Models\ConstructionType', 'construction_type_id', 'id');
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
        return Carbon::parse($timestamp)->format('d.m.Y H:i:s');
    }

    public function scopeFilter($query)
    {
        if(request('order_id'))
        {
            $query->where('order_id', request('order_id'));
        }
        if(request('startDate') && request('endDate')) {
            $startDate = Carbon::create(request('startDate'))->tz('Europe/Minsk');
            $endDate = Carbon::create(request('endDate'))->tz('Europe/Minsk');
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        if(request('deleted'))
        {
            $query->onlyTrashed();
        }
        return $query;
    }
}
