<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockInventoryCreateValidation extends FormRequest
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
            'notes.*'=>'nullable|numeric',
            'currency'=>'required',
        ];
    }
//    public function messages()
//    {
//        $messages = [];
//        foreach ($this->get('notes') as $key => $val) {
//            $messages["external_media.$key.active_url"] = "$val is not a valid active url";
//        }
//
//        return $messages;
//    }
}
