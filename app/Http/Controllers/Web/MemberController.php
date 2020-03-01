<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberStoreRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Model\Member;
use App\Model\ExchangeType;
use App\Model\MemberType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class MemberController extends Controller
{
    public function index()
    {

        $member_types=MemberType::all();
        $exchange_types=ExchangeType::all();
        $members=Member::with('member_type','exchange_type')->latest()->paginate(config('global.pagination_page'));
        return view('Member.index',compact('members','member_types'));
    }
    public function store(Request $request)
    {
        $vData=Validator::make($request->all(),[
            'name'=>'required',
            'company'=>'required',
            'years'=>'required',
            'months'=>'required',
            'days'=>'required',
            'address'=>'required',
            'phone_number'=>'required',
            'email'=>'required|unique:members',
//            'state'=>'required',
            'exchange_type'=>'required',
            'member_type'=>'required',
            'points'=>'required',

        ]);
//        if($vData->passes()){
//            dd('a');
//        }else{
//            dd('b');
//        }
        if($vData->fails()){
            return response()->json([
                'errors'=>$vData->errors()
            ]);
        }else {
            $member=new Member();
            $member->name=$request->name;
            $member->company=$request->name;
            $member->date_of_birth=Carbon::create($request->years,$request->months,$request->days);
            $member->address=$request->address;
            $member->phone_number=$request->phone_number;
            $member->date_for_point_changes=now();
            $member->email=$request->email;
            $member->exchange_type_id=$request->exchange_type;
            $member->member_type_id=$request->member_type;
            $member->points=$request->points;
            $member->save();
            return response()->json([
                'success'=>true,
            ]);
        }
    }
    public function edit($id)
    {
        $member=Member::find($id);
        return $member;
    }
    public function update(Request $request)
    {
        $id=$request->id;
        $vData=Validator::make($request->all(),[
            'name'=>'required',
            'company'=>'required',
            'years'=>'required',
            'months'=>'required',
            'days'=>'required',
            'address'=>'required',
            'phone_number'=>'required|unique:members,phone_number,'.$id,
            'email'=>'required|unique:members,email,'.$id,
//            'state'=>'required',
            'exchange_type'=>'required',
            'member_type'=>'required',
            'points'=>'required',

        ]);
        if($vData->fails()){
            return response()->json([
                'errors'=>$vData->errors()
            ]);
        }else{
            $member=Member::whereId($request->id)->firstOrfail();
            $member->name=$request->name;
            $member->company=$request->name;
            $member->date_of_birth=Carbon::create($request->years,$request->months,$request->days);
            $member->address=$request->address;
            $member->phone_number=$request->phone_number;
            $member->email=$request->email;
//            $member->date_for_point_changes=now();
            $member->exchange_type_id=$request->exchange_type;
            $member->member_type_id=$request->member_type;
            $member->points=$request->points;
            $member->save();
            return response()->json([
                'success'=>true,
                'message'=>'Update Successfully',
            ]);
        }

    }
    public function member_type_filter($member_type_id)
    {
        $members=Member::where('member_type_id','=',$member_type_id)->get();
        $member_type_filter=view('Member.member_type_filter',compact('members'))->render();
        return $member_type_filter;
    }
    public function search(Request $request)
    {
        $name=Input::get('name');
        if($request->has('name'))
        {
            $members=Member::where('name','LIKE','%'.$name.'%')->paginate(10);
            return view('Member.index',compact('members'));
        }
    }
    public function non_member()
    {
        return view('Member.non_member');
    }
    public function destroy(Request $request)
    {
        $member=Member::find($request->id);
        $member->delete();
        return redirect('member');
    }
}
