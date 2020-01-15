<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellGroupValue extends Model
{

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function sell()
    {
        return $this->morphTo(SellGroupValue::class,'classable');
    }
}
