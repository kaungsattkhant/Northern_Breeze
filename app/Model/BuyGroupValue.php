<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BuyGroupValue extends Model
{
    protected $with='group';
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
