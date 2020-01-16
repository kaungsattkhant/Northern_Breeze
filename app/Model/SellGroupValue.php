<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellGroupValue extends Model
{

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
