<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RollStorageMaterial extends Model
{
    public function storageable()
    {
        return $this->morphTo();
    }
}
