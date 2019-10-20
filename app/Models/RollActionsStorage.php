<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RollActionsStorage extends Model
{
    protected $fillable = [
        'type_id', 'user_id', 'reason', 'width', 'lenght'
    ];

    public function rollStorage()
    {
        return $this->belongsTo('App\Models\RollStorage', 'roll_storage_id');
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
}
