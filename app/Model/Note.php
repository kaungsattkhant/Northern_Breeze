<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}
