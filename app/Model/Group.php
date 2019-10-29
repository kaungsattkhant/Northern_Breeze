<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function notes()
    {
        return $this->belongsToMany(Note::class);
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
