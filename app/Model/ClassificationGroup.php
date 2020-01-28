<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClassificationGroup extends Model
{
    protected $table='classification_group';
    public $timestamps=false;
    protected $fillable=['classification_id','group_id'];

}
