<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable=['name','dob','email','phone_number','address','exchange_type','member_type','company','state'];
}
