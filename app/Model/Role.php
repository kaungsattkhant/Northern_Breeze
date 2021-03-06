<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable=['name'];
    public $timestamps=false;
    public function staff(){
        return $this->belongsToMany(Staff::class);
    }
}
