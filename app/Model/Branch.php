<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function branch_group_note()
    {
        return $this->belongsToMany(GroupNote::class,'branch_group_note')->withPivot('sheet');
    }
}
