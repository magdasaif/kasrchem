<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
            'name_ar'=>'required',
            'name_en'=>'required|regex:/^[a-zA-Z_@.\s\#&+(){}:,-][a-zA-Z0-9_@.\s\#&+(){}:,-]+$/uu',
            
        ];
    }
    public function messages()
    {
        return $messages = [
        'name_ar.required' =>'اسم الشريك بالعربية مطلوب',
        'name_en.required' => 'اسم الشريك بالانجليزية مطلوب',
        'name_en.regex' => '  يجب ان يكون اسم الشريك باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',
      
        ];
    }
}
