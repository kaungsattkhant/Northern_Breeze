<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Member;
use App\Model\ExchangeType;
use App\Model\MemberType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        $member_types=MemberType::all();
        $exchange_types=ExchangeType::all();
        return view('Member.index',compact('member_types','exchange_types'));
    }
    public function store(Request $request)
    {
//        $vData=Validator::make($request->all(),[
//            'name'=>'required',
//            'company'=>'required',
//            'dob'=>'required',
//            'address'=>'required',
//            'phone_number'=>'required',
//            'email'=>'required',
//            'state'=>'required',
//            'exchange_type'=>'required',
//            'member_type'=>'required',
//        ]);

        $member=new Member();
        $member->name=$request->name;
        $member->company=$request->name;
        $member->date_of_birth=$request->dob;
        $member->address=$request->address;
        $member->phone_number=$request->phone_number;
        $member->email=$request->email;
        $member->exchange_type_id=$request->exchange_type;
        $member->member_type_id=$request->member_type;
        $member->save();
        return response()->json([
            'success'=>true,
        ]);
    }
    public function non_member()
    {
        return view('Member.non_member');
    }
}
