<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    public function in_transaction_group_note()
    {
        return $this->belongsToMany(InTransactionGroupNote::class,'in_transaction_group_note','transaction_id','group_note_id')->withPivot('buy_group_value_id','sheet');
    }
//    public function buy_group_value(){
//        return $this->belongsToMany(BuyGroupValue::class)->with('group_note_id');
//    }
    public function out_transaction_group_note()
    {
        return $this->belongsToMany(OutTransactionGroupNote::class,'out_transaction_group_note','transaction_id','group_note_id')->withPivot('out_group_value_id','sheet');
    }
    public function in_MMK_group_note()
    {
        return $this->belongsToMany(GroupNote::class,'in_MMK_group_note','transaction_id','group_note_id')->withPivot('sheet');
    }
    public function out_MMK_group_note()
    {
        return $this->belongsToMany(GroupNote::class,'out_MMK_group_note','transaction_id','group_note_id')->withPivot('sheet');

    }
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
    public function to_currency()
    {
        return $this->belongsTo(Currency::class,'to_currency_id');
    }
    public function from_currency()
    {
        return $this->belongsTo(Currency::class,'from_currency_id');
    }
    public function latestPost()
    {
        return $this->hasOne(Staff::class)->latest();
    }
}
