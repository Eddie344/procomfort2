<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;

class RollActionsStorage extends Model
{
    protected $fillable = [
        'roll_storage_id', 'type_id', 'user_id', 'reason', 'width', 'lenght'
    ];

    public function rollStorage()
    {
        return $this->belongsTo('App\Models\RollStorage', 'roll_storage_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\ActionType', 'type_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('d.m.Y H:i:s');
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
        if(request('roll_storage_id'))
        {
            $query->where('roll_storage_id', request('roll_storage_id'));
        }
        return $query;
    }

    public function scopeIndex($query, $id)
    {
        return $query->with(['type', 'user', 'rollStorage'])->where('roll_storage_id', $id)->orderBy('created_at', 'DESC');
    }
}
