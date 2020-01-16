<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellClassGroupValue extends Model
{
    public function sell_classes(){
        return $this->morphMany(SellClassGroupValue::class,'out_classable');
    }
}
