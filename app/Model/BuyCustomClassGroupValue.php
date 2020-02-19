<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BuyCustomClassGroupValue extends Model
{
    protected $fillable=['value','classification_group_id','date_time'];
    public function buy_custom_classes(){
        return $this->morphMany(BuyCustomClassGroupValue::class,'in_classable');
    }
}
