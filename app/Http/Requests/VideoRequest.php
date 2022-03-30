<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            // 'main_category' => 'required',
            // 'sub2' => 'required',
            // 'sub3' => 'required',
            // 'sub4' => 'required',

             'title_ar' => 'required',
             'title_en' => 'required|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu',
             'link' => 'required',
             'status' => 'required',

          
        ];
    }
    public function messages()
    {
        return $messages = [
            // 'main_category.required'=>'تاكد من اختيار تصنيف رئيسى',
            // 'sub2.required'=>'تاكد من اختيار تصنيف فرعى',
            // 'sub3.required'=>'تاكد من اختيار نوع رئيسى',
            // 'sub4.required'=>'تاكد من اختيار نوع فرعى',

             'title_ar.required' =>'عنوان الفيديو بالعربية مطلوب',
             'title_en.required' => 'عنوان الفيديو بالانجليزية مطلوب',
             'title_en.regex' => '  يجب ان يكون عنوان الفيديو  باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',
             'link.required' =>'رابط الفيديو مطلوب',
             'status.required' =>'الحالة مطلوبة',
             
        ];
    }
}
