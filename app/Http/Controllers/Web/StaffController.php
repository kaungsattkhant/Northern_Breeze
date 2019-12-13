<?php

namespace App\Http\Controllers\Web;

use App\Model\Role;
use App\Model\Staff;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
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
//        return response()->json($request->all());
        $vData=Validator::make($request->all(),[
            'name'=>"required",
            'email'=>"required|unique:staff|email",
            'password'=>'required',
            'password_confirmation'=>'required|same:password',
            'role'=>'required',
            'branch'=>'nullable'
        ]);
        if($vData->passes())
        {
            $staff=new Staff();
            $staff->name=$request['name'];
            $staff->email=$request['email'];
            $staff->password=bcrypt($request['password']);
            $staff->role_id=$request['role'];
            $request->branch ? $staff->branch_id=$request['branch'] : $staff->branch_id=null;
//            $staff->branch_id=$request['branch'];
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
//        dd($staff);
        return $staff   ;
    }
    public function update(Request $request)
    {
//        return response()->json($request->all());
        $vData = Validator::make($request->all(), [
            'name' => "required",
            'email' => "required|unique:staff,email," . $request->id,
            'role' => 'required',
            'branch'=>'nullable',
        ]);
        if ($vData->passes())
        {
            $staff=Staff::whereId($request->id)->firstOrfail();
            $staff->name=$request->name;
            $staff->email=$request->email;
            $staff->role_id=$request->role;
//            $staff->branch_id=$request->branch;
            $request->branch ? $staff->branch_id=$request['branch'] : $staff->branch_id=null;
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
    public function role_filter($id)
    {
        $staff=Staff::where('role_id','=',$id)->get();
        $role_filter=view('Staff.role_filter',compact('staff'));
        return $role_filter;
    }
    public function search(Request $request)
    {
        $name=Input::get('name');
        if($request->has('name'))
        {
            $staff=Staff::with('role')->where('name','LIKE','%'.$name.'%')->paginate(10);
            return view('Staff.index',compact('staff','roles'));
        }
    }
    public function destroy(Request $request)
    {
//        dd($request->all());
        $staff=Staff::find($request->id);
        $staff->delete();
        return redirect('/staff');
    }
}
