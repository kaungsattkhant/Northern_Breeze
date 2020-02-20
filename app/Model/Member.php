<?php

namespace App\Model;

use App\Model\ExchangeType;
use App\Model\MemberType;
use App\Model\Role;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable=['name','dob','email','phone_number','address','exchange_type_id','member_type_id','company','state','points','date_for_point_changes'];
    public function exchange_type()
    {
        return $this->belongsTo(ExchangeType::class);
    }
    public function member_type()
    {
        return $this->belongsTo(MemberType::class);
    }

}
