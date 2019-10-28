<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberStoreRequest extends FormRequest
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
    public function rules()
    {
        return [
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
        ];
    }
}
