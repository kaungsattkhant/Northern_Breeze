<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
class Staff extends Authenticable
{
    public $timestamps=false;
    protected $fillable=['name','email','role','password','password_confirmation'];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
