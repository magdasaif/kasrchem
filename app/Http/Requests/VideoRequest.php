<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        if(isset($this->id)){$cond=decrypt($this->id);}else{$cond='';}
        return [
            'name_ar'        => 'required|unique:videos,name_ar,'.$cond,
            'name_en'        => 'required|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu|unique:videos,name_en,'.$cond,
            'link'           => 'required|url',
            'status'         => 'required',
            'sort'           =>'integer',

          
        ];
    }
    public function messages()
    {
        return $messages = [
            'name_ar.required'          =>'عنوان الفيديو بالعربية مطلوب',
            'name_en.required'          => 'عنوان الفيديو بالانجليزية مطلوب',
            'name_ar.unique'            =>'عنوان الفيديو بالعربية مسجل مسبقا ...قم بادخال عنوان اخر',
            'name_en.unique'            =>'عنوان الفيديو بالانجليزية مسجل مسبقا ...قم بادخال عنوان اخر',
            'name_en.regex'             => '  يجب ان يكون عنوان الفيديو  باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',
            'link.required'             =>'رابط الفيديو مطلوب',
            'link.url'                  =>' قم بادخال الرابط بالشكل المناسب',
            'status.required'           =>'الحالة مطلوبة',
            'sort.integer'              =>'الترتيب يجب ان يكون رقم',
             
        ];
    }
}
