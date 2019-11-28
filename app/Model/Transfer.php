<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    public function group_note()
    {
        return $this->belongsToMany(GroupNote::class)->withPivot('sheet');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    public function branch()
    {
     return $this->belongsTo(Branch::class,'to_branch_id');
    }
}
