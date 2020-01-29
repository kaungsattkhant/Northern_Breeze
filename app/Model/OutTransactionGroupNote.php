<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OutTransactionGroupNote extends Model
{
    protected $table='out_transaction_group_note';
    public $timestamps=false;

    public function out_classable(){
        return $this->morphTo();
    }
}
