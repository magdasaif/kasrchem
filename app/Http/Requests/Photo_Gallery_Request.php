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
          'title_en' => 'required',
           'status' => 'required',
          
        ];
    }
    public function messages()
    {
        return $messages = [
             'title_ar.required' =>'اسم المعرض بالعربية مطلوب',
             'title_en.required' => '  اسم المعرض  بالانجليزية مطلوب',
             'status.required' =>'الحالة مطلوبة',
        ];
    }
}
