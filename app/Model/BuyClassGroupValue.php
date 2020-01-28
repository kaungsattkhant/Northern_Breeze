<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BuyClassGroupValue extends Model
{
    protected $fillable=['value','date_time','classification_group_id'];
    public function buy_classes(){
        return $this->morphMany(BuyClassGroupValue::class,'in_classable');
    }
}
