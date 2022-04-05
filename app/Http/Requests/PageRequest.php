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
        'title_en' => 'required|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu',
        'description_ar' => 'required|max:150',
        'description_en' => 'required|max:150',
        'content_ar' => 'required',
        'content_en' => 'required',
        'status' => 'required',
        'photos.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg|dimensions:max_width=1200,max_height=600,min_width=850,min_height=315'. $this->id,
          
        ];
    } 
    public function messages()
    {
        return $messages = [
        'title_ar.required' =>'عنوان الصفحة بالعربية مطلوب',
        'title_en.required' => 'عنوان الصفحة بالانجليزية مطلوب',
        'title_en.regex' => '  يجب ان يكون عنوان الصفحة باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',

        'description_ar.required' =>'وصف الصفحة بالعربية مطلوب',
        'description_en.required' => 'وصف الصفحة بالانجليزية مطلوب',

        'description_ar.max' =>'وصف الصفحة بالعربية لا يجب ان يتعدى 150 حرف',
        'description_en.max' => 'وصف الصفحة بالانجليزية لا يجب ان يتعدى 150 حرف',
        
        'content_ar.required' =>'محتوى الصفحة بالعربية مطلوب',
        'content_en.required' =>'محتوى الصفحة بالانجليزية مطلوب',
        'status.required' =>'الحالة مطلوبة',

        'photos.*.dimensions'=>'الأبعاد [يجب أن يكون العرض بين (850 و 1200) ، ويجب أن يكون الارتفاع بين (315 و 600)]',
        ];
    }
}
