<?php

namespace App\Http\Controllers\Web;

use App\Model\Role;
use App\Model\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{

    public function index()
    {
       $roles=Role::all();
       $staff=Staff::with('role')->latest()->paginate(10);
        return view('Staff.index',compact('staff','roles'));
    }
    public function store(Request $request)
    {

        $vData=Validator::make($request->all(),[
            'name'=>"required",
            'email'=>"required|unique:staff",
            'password'=>'required',
            'password_confirmation'=>'required|same:password',
            'role'=>'required',
//            'branch'=>'branch'
        ]);
        if($vData->passes())
        {
            $staff=new Staff();
            $staff->name=$request['name'];
            $staff->email=$request['email'];
            $staff->password=bcrypt($request['password']);
            $staff->role_id=$request['role'];
            $staff->save();
            return response()->json([
                'success'=>true,
                'message'=>'Staff create successfully',
            ]);
        }
        return response()->json([
            'errors'=>$vData->errors(),
        ]);

    }
    public function edit($id)
    {
        $staff=Staff::find($id);
        return $staff;
    }
    public function update(Request $request)
    {
        $vData = Validator::make($request->all(), [
            'name' => "required",
            'email' => "required|unique:staff,email," . $request->id,
            'role' => 'required',
        ]);
        if ($vData->passes())
        {
            $staff=Staff::whereId($request->id)->firstOrfail();
            $staff->name=$request->name;
            $staff->email=$request->email;
            $staff->role_id=$request->role;
            $staff->save();
            return response()->json([
                'success'=>true,
                'message'=>'Staff Update successfully',
            ]);
        }
        return response()->json([
            'errors'=>$vData->errors(),
        ]);

    }
}
