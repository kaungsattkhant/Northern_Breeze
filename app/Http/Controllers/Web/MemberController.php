<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberStoreRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Member;
use App\Model\ExchangeType;
use App\Model\MemberType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class MemberController extends Controller
{
    public function index()
    {
        $member_types=MemberType::all();
        $exchange_types=ExchangeType::all();
        $members=Member::with('member_type','exchange_type')->latest()->paginate(10);
        return view('Member.index',compact('members','member_types'));
    }
    public function store(MemberStoreRequest $request)
    {
        $vData=$request->validated();

            $member=new Member();
            $member->name=$request->name;
            $member->company=$request->name;
            $member->date_of_birth=Carbon::create($request->years,$request->months,$request->days);
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
    public function edit($id)
    {
        $member=Member::find($id);
        return $member;
    }
    public function update(MemberUpdateRequest $request)
    {
//        dd($request->all());
        $vData=$request->validated();
        $member=Member::whereId($request->id)->firstOrfail();
        $member->name=$request->name;
        $member->company=$request->name;
        $member->date_of_birth=Carbon::create($request->years,$request->months,$request->days);
        $member->address=$request->address;
        $member->phone_number=$request->phone_number;
        $member->email=$request->email;
        $member->exchange_type_id=$request->exchange_type;
        $member->member_type_id=$request->member_type;
        $member->save();
        return response()->json([
            'success'=>true,
            'message'=>'Update Successfully',
        ]);
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
