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
        if (request('date_period')) {
            $dates = explode(' - ', (request('date_period')));
            $startDate = Carbon::createFromFormat('d/m/Y', $dates[0]);
            $endDate = Carbon::createFromFormat('d/m/Y', $dates[1]);
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        if (request('type'))
        {
            $query->where('type_id', request('type'));
        }
        return $query;
    }

    public function scopeIndex($query, $id)
    {
        return $query->with(['type', 'user', 'vertStorage'])->where('vert_storage_id', $id)->orderBy('created_at', 'DESC');
    }
}
