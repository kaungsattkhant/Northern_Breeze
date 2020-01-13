<?php

namespace App;

use App\Model\ExchangeType;
use App\Model\MemberType;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable=['name','dob','email','phone_number','address','exchange_type','member_type','company','state'];
    public function exchange_type()
    {
        return $this->belongsTo(ExchangeType::class);
    }
    public function member_type()
    {
        return $this->belongsTo(MemberType::class);
    }
}
