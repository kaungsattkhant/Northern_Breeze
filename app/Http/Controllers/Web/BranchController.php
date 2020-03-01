<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\Branch;

class BranchController extends Controller
{
    public function index(){
        $branches=Branch::all();
        return view('Branch.index',compact('branches'));
    }
    public function store(Request $request){
        $vd=Validator::make($request->all(),[
            'name'=>'required',
            'phone_number'=>'required|unique:branches',
            'address'=>'required',
            'branch_type'=>'required',
        ]);
        if($vd->passes()){
            Branch::create([
                'name'=>$request->name,
                'address'=>$request->address,
                'phone_number'=>$request->phone_number,
                'branch_type_id'=>$request->branch_type,
            ]);
            return response()->json([
                'is_success'=>true,
            ]);
        }else{
            return response()->json([
                'is_success'=>false,
                'errors'=>$vd->errors(),
            ]);
        }

    }
    public function edit($id){

    }
    public function update(Request $request){

    }
    public function destroy(){

    }

}
