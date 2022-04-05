<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        'title_en' => 'required|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu',
        'content_ar' => 'required',
        'content_en' => 'required',
        'status' => 'required',
          
        ];
    }
    public function messages()
    {
        return $messages = [
        'title_ar.required' =>'عنوان المقال بالعربية مطلوب',
        'title_en.required' => 'عنوان المقال بالانجليزية مطلوب',
        'title_en.regex' => '  يجب ان يكون عنوان المقال باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',
        'content_ar.required' =>'محتوى المقال بالعربية مطلوب',
        'content_en.required' =>'محتوى المقال بالانجليزية مطلوب',
        'status.required' =>'الحالة مطلوبة',
        ];
    }
}
