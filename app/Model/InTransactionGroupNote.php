<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class InTransactionGroupNote extends Model
{
    protected $table='in_transaction_group_note';
//    protected $table='in_transaction_group_note';
    public $timestamps=false;
    public function in_classable(){
        return $this->morphTo();
    }
}
