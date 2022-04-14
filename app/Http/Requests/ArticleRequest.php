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
        if(isset($this->id)){
            $cond=decrypt($this->id);
            $req='';
        }else{
            $cond='';
            $req='|required';
        }
        
        return [
     
        'name_ar'       => 'required|unique:articles,name_ar,'.$cond,
        'name_en'       => 'required|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu|unique:articles,name_en,'.$cond,
        'content_ar'    => 'required',
        'content_en'    => 'required',
        'status'        => 'required',
        'sort'          =>'integer',
        'image'         =>'image|mimes:jpg,png,jpeg,gif,svg|max:2048'. $req,
          
        ];
    }
    public function messages()
    {
        return $messages = [
        'name_ar.required'      =>'عنوان المقال بالعربية مطلوب',
        'name_en.required'      => 'عنوان المقال بالانجليزية مطلوب',
        'name_en.regex'         => '  يجب ان يكون عنوان المقال باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',
        'name_ar.required'      =>'اسم المقال بالعربية مطلوب',
        'name_en.required'      => '  اسم المقال  بالانجليزية مطلوب',
       
        'content_ar.required'   =>'محتوى المقال بالعربية مطلوب',
        'content_en.required'   =>'محتوى المقال بالانجليزية مطلوب',
        'status.required'       =>'الحالة مطلوبة',
        'image.required'        =>'تاكد من ادخال صوره صحيحه',
        'sort.integer'          =>'الترتيب يجب ان يكون رقم',
        ];
    }
}
