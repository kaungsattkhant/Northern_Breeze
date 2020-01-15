<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutTransactionGroupNote extends Model
{
    protected $table='out_transaction_group_note';
    public function sell_classable(){
        return $this->morphTo();
    }
}
