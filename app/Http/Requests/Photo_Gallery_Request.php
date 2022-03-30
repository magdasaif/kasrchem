<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Photo_Gallery_Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
          'title_ar' => 'required',
          'title_en' => 'required|regex:/^[a-zA-Z_@.\s\#&+(){}-][a-zA-Z0-9_@.\s\#&+(){}-]+$/uu',
           'status' => 'required',
          
        ];
    }
    public function messages()
    {
        return $messages = [
             'title_ar.required' =>'اسم المعرض بالعربية مطلوب',
             'title_en.required' => '  اسم المعرض  بالانجليزية مطلوب',
             'title_en.regex' => '  يجب ان يكون اسم المعرض باللغة الانجليزية وايضا لا يكون ارقام فقط',
             'status.required' =>'الحالة مطلوبة',
        ];
    }
}
