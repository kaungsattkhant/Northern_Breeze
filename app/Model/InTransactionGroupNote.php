<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InTransactionGroupNote extends Model
{
    protected $table='in_transaction_group_note';
    public function group_note()
    {
//        return $this->belongsToMany()
    }
}
