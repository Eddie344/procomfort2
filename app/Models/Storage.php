<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label', 'type_id', 'provider_id',
    ];

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider', 'provider_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\StoragesType', 'type_id', 'id');
    }
}
