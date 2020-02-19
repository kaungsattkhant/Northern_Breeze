<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellCustomClassGroupValue extends Model
{
    protected $fillable=['value','classification_group_id','date_time'];
    public function sell_custom_classes(){
        return $this->morphMany(SellCustomClassGroupValue::class,'out_classable');
    }
}
