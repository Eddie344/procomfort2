<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ZebraActionsStorage extends Model
{
    protected $fillable = [
        'zebra_storage_id', 'type_id', 'user_id', 'reason', 'width', 'lenght'
    ];

    public function zebraStorage()
    {
        return $this->belongsTo('App\Models\ZebraStorage', 'zebra_storage_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\StorageActionType', 'type_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('d.m.Y H:i');
    }

    public function scopeFilter($query)
    {
        if(request('startDate') && request('endDate')) {
            $startDate = Carbon::create(request('startDate'))->tz('Europe/Minsk');
            $endDate = Carbon::create(request('endDate'))->tz('Europe/Minsk');
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        if (request('type'))
        {
            $query->where('type_id', request('type'));
        }
        if(request('zebra_storage_id'))
        {
            $query->where('zebra_storage_id', request('zebra_storage_id'));
        }
        return $query;
    }

    public function scopeIndex($query, $id)
    {
        return $query->with(['type', 'user', 'zebraStorage'])->where('zebra_storage_id', $id)->orderBy('created_at', 'DESC');
    }
}
