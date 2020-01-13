<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(\Illuminate\Http\Request $request)
    {
        $id=$request->id;
//        dd($id);
        return [
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
            'member_type'=>'required',        ];
    }
}
