<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class VertActionsStorage extends Model
{
    protected $fillable = [
        'type_id', 'user_id', 'reason', 'lenght'
    ];

    public function vertStorage()
    {
        return $this->belongsTo('App\Models\VertStorage', 'vert_storage_id');
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
            $startDate = Carbon::create(request('startDate'));
            $endDate = Carbon::create(request('endDate'));
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        if (request('type'))
        {
            $query->where('type_id', request('type'));
        }
        if(request('vert_storage_id'))
        {
            $query->where('vert_storage_id', request('vert_storage_id'));
        }
        return $query;
    }

    public function scopeIndex($query, $id)
    {
        return $query->with(['type', 'user', 'vertStorage'])->where('vert_storage_id', $id)->orderBy('created_at', 'DESC');
    }
}
