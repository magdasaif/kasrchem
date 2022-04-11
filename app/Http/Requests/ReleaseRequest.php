<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReleaseRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // if(isset($this->id)){$cond=decrypt($this->id);}else{$cond='';}
        $cond=$this->id;
        return [
        //    'name_ar'  => 'unique:releases,name_ar|required,'.$cond,
        //    'name_en' => 'unique:releases,name_en|required,'.$cond.'|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu',
          /// 'name_ar'  => 'required'.$cond,
          'name_en' => 'regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu',
           'status'  => 'required',
           'sort'    =>  'required|integer',
           'image'   =>'image|mimes:jpg,png,jpeg,gif,svg|required,'.$cond,
           'file'     =>'mimes:csv,txt,xlx,xls,pdf|required,'.$cond,
           'sort'    =>  'integer',
           'image'   =>'image|mimes:jpg,png,jpeg,gif,svg',
           'file'     =>'mimes:csv,txt,xlx,xls,pdf',
          
        ];
    }
    public function messages()
    {
        return $messages = [
           //'name_ar.required'   =>   'اسم النشرة بالعربية مطلوبة',
            //'name_ar.unique'     =>   'اسم النشرة بالعربية مسجل  من قبل قم بادخال اسم اخر',
           // 'name_en.required'   =>   '  اسم النشرة  بالانجليزية مطلوبة',
           // 'name_en.unique'      =>   'اسم النشرة بالانجليزية مسجل  من قبل قم بادخال اسم اخر',
            'name_en.regex'      =>   '  يجب ان يكون اسم النشرة باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',
            'status.required'    =>   'الحالة مطلوبة',
            'sort.required'      =>   'الترتيب مطلوبة',
            'sort.integer'       =>    'يجب ان يكون الترتيب رقم',
            'image.required'     =>   'الصورة مطلوبة',
            'image.mimes'        =>   'الصورة مطلوبة بالامتداداتjpg,png,jpeg,gif,svg',
           'file.required'     =>   'الملف مطلوب',
            'file.mimes'        =>   'الملف مطلوب بالامتداداتjpg,png,jpeg,gif,svg',

        ];
    }
}




