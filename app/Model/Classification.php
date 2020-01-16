<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
  public  function groups()
  {
      return $this->belongsToMany(Group::class);
  }
}
