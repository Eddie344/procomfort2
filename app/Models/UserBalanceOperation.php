<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserBalanceOperation extends Model
{
    protected $guarded = [];

    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('d.m.Y H:i:s');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\ActionType', 'type_id');
    }

    public function scopeFilter($query)
    {
        if(request('startDate') && request('endDate')) {
            $startDate = Carbon::create(request('startDate'))->tz('Europe/Minsk');
            $endDate = Carbon::create(request('endDate'))->tz('Europe/Minsk');
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        if(request('type'))
        {
            $query->where('type_id', request('type'));
        }
        if(request('user_id'))
        {
            $query->where('user_id', request('user_id'));
        }
        return $query;
    }
}
