<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $with='currency';
    protected $fillable=['to_branch_id','from_branch_id','date_time','currency_id'];
//    protected $dates='date_time';
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
    public function transfer_group()
    {
        return $this->belongsToMany(Group::class,'transfer_group','transfer_id','group_id')->withPivot('value');
    }
    public function transfer_classification_group()
    {
        return $this->belongsToMany(ClassificationGroup::class,'transfer_class_group','transfer_id','classification_group_id')->withPivot('value');
    }
    public function transfer_group_note_class(){
        return $this->belongsToMany(GroupNote::class,'transfer_group_note_class','transfer_id','group_note_id')->withPivot('class_id','sheet');
    }

    public function isClassableCurrency(){
        foreach($this->currency()->get() as $c){
            if($c->name==="United States dollar"){
                return true;
            }
        }
    }
    public function isMyanmarCurrency(){
        foreach($this->currency()->get() as $c){
            if($c->name==="Myanmar Kyat"){
                return true;
            }
        }
    }
}
