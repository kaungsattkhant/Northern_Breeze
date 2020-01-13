<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public $timestamps=false;
    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
