<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BuyGroupValue extends Model
{
    protected $with='group';
//    protected $dates = ['date_time'];
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function classes(){
        return $this->morphMany(BuyGroupValue::class,'in_classable');
    }
}
