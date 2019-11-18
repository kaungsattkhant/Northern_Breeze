<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    public function group_note()
    {
        return $this->belongsToMany(GroupNote::class)->withPivot('sheet');
    }
}
