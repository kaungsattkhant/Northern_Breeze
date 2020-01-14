<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClassValue extends Model
{
    public function classification_group()
    {
        return $this->belongsTo(ClassificationGroup::class);
    }
}
