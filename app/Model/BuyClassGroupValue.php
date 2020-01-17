<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BuyClassGroupValue extends Model
{
    public function buy_classes(){
        return $this->morphMany(BuyClassGroupValue::class,'in_classable');
    }
}
