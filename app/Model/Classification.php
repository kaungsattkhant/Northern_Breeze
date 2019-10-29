<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
  public  function currencies()
  {
      return $this->belongsToMany(Currency::class);
  }
}
