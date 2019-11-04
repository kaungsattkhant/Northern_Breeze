<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function notes()
    {
        return $this->belongsToMany(Note::class);
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    public function classifications()
    {
        return $this->belongsToMany(Classification::class)->withPivot('id');
    }
    public function buying_price()
    {
        return $this->hasMany(BuyGroupValue::class);

    }

    public function selling_price()
    {
        return $this->hasMany(SellGroupValue::class);
    }
}
