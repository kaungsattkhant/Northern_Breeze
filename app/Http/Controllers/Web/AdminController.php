<?php

namespace App\Http\Controllers\Web;

use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
//        return view('Admin.index');
        $roles=Role::all();
        $admins=Admin::with('role')->latest()->paginate(10);
        return view('Admin.index',compact('admins','roles'))->with('i', (request()->input('page', 1) - 1) * 10);

    }
    public function store(Request $request)
    {
        $rules=Validator::make($request->all(),[
            'name'=>'required',
            'password'=>'required|min:6',
            'password_confirmation'=>'required|same:password',
            'role'=>'required',
        ]);
      $admin=new Admin();
      $admin->name=$request->name;
      $admin->password=bcrypt($request->password);
      $admin->role_id=$request->role;
      $admin->save();
      return response()->json([
          'is_success'=>true,
          'message'=>'Successfully',
      ]);
    }
    public function destroy(Request $request)
    {
        $admin=Admin::findOrfail($request->id);
        $admin->delete();
        return back();
    }
}
