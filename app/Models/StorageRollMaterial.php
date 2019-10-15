<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageRollMaterial extends Model
{
    public function storageable()
    {
        return $this->morphTo();
    }
}
