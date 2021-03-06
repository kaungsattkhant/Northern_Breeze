<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public $timestamps=false;
    protected $fillable=['name','address','phone_number','branch_type_id'];
    public function branch_type(){
        return $this->belongsTo(BranchType::class);
    }
    public function branch_group_note()
    {
        return $this->belongsToMany(GroupNote::class,'branch_group_note','branch_id','group_note_id')->withPivot('sheet');
    }
    public function branch_group_note_class(){
        return $this->belongsToMany(GroupNote::class,'branch_group_note_class','branch_id','group_note_id')->withPivot('class_id','sheet');
    }
}
