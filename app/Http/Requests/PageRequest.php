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
        if(isset($this->id)){
            $cond=decrypt($this->id);
            $req='';
        }else{
            $cond='';
            $req='|required';
        }

       
        return [
     
        'name_ar'        =>'required|unique:pages,name_ar,'.$cond,
        'name_en'        =>'required|unique:pages,name_en,'.$cond.'|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu',

        'description_ar' => 'required|max:150',
        'description_en' => 'required|max:150',
        'content_ar'     => 'required',
        'content_en'     => 'required',
        'status'         => 'required',
        'sort'           =>'integer',
        'photos.*'       => 'required|image|mimes:jpg,png,jpeg,gif,svg',
          
        ];
    } 
    public function messages()
    {
        return $messages = [
        'name_ar.required'         =>'عنوان الصفحة بالعربية مطلوب',
        'name_en.required'         => 'عنوان الصفحة بالانجليزية مطلوب',
        'name_en.regex'            => '  يجب ان يكون عنوان الصفحة باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',

        'name_ar.unique'           =>'اسم الصفحه باللغه العربيه مُضاف مسبقا... قم بادخال اسم اخر ',
        'name_en.unique'           =>'اسم الصفحه باللغه الانجليزيه مُضاف مسبقا... قم بادخال اسم اخر ',
       
        'description_ar.required'  =>'وصف الصفحة بالعربية مطلوب',
        'description_en.required'  => 'وصف الصفحة بالانجليزية مطلوب',

        'description_ar.max'       =>'وصف الصفحة بالعربية لا يجب ان يتعدى 150 حرف',
        'description_en.max'       => 'وصف الصفحة بالانجليزية لا يجب ان يتعدى 150 حرف',
        
        'content_ar.required'      =>'محتوى الصفحة بالعربية مطلوب',
        'content_en.required'      =>'محتوى الصفحة بالانجليزية مطلوب',
        'status.required'          =>'الحالة مطلوبة',

        'sort.integer'             =>'الترتيب يجب ان يكون رقم',

        ];
    }
}
