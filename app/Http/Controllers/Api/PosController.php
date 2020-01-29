<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PosController extends Controller
{

    public function transaction(){
        $data=file_get_contents(storage_path().'/api/transaction_store.json');
        $decode_data=json_decode($data);
//        dd($decode_data);
        return response()->json($decode_data);
    }
}
