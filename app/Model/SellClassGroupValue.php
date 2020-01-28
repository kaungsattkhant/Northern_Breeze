<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellClassGroupValue extends Model
{
    protected $fillable=['value','date_time','classification_group_id'];
    public function sell_classes(){
        return $this->morphMany(SellClassGroupValue::class,'out_classable');
    }
}
