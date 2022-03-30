<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReleaseRequest extends FormRequest
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

    public function rules()
    {
        return [
          'title_ar' => 'required',
         // 'title_en' => 'required',
            'title_en' => 'required|regex:/^[a-zA-Z_@.\s\#&+(){}-][a-zA-Z0-9_@.\s\#&+(){}-]+$/uu',
           'status' => 'required',
          
        ];
    }
    public function messages()
    {
        return $messages = [
             'title_ar.required' =>'اسم النشرة بالعربية مطلوبة',
             'title_en.required' => '  اسم النشرة  بالانجليزية مطلوبة',
             'title_en.regex' => '  يجب ان يكون اسم النشرة باللغة الانجليزية وايضا لا يكون ارقام فقط',
             'status.required' =>'الحالة مطلوبة',
        ];
    }
}
