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
        'label', 'route',
    ];

//    public function type()
//    {
//        return $this->belongsTo('App\Models\StoragesType', 'type_id', 'id');
//    }
//
//    public function storage()
//    {
//        return $this->morphMany('App\Models\StorageRollMaterial', 'storageable');
//    }
//
//    public function categoriable()
//    {
//        return $this->morphTo();
//    }

}
