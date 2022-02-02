<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
        'description_ar' => 'required',
        'description_en' => 'required',
        'content_ar' => 'required',
        'content_en' => 'required',
        'status' => 'required',
          
        ];
    } 
    public function messages()
    {
        return $messages = [
        'title_ar.required' =>'عنوان الصفحة بالعربية مطلوب',
        'title_en.required' => 'عنوان الصفحة بالانجليزية مطلوب',
        'description_ar.required' =>'وصف الصفحة بالعربية مطلوب',
        'description_en.required' => 'وصف الصفحة بالانجليزية مطلوب',
        'content_ar.required' =>'محتوى الصفحة بالعربية مطلوب',
        'content_en.required' =>'محتوى الصفحة بالانجليزية مطلوب',
        'status.required' =>'الحالة مطلوبة',
        ];
    }
}
