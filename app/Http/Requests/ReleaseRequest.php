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
          if(isset($this->id)){
              $cond=decrypt($this->id);
              $req='';
          }else{
              $cond='';
              $req='|required';
          }
          
          return [
            //   'name_ar'        =>'required|unique:releases,name_ar,'.$cond,
            //   'name_en'        =>'required|unique:releases,name_en,'.$cond.'|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu',
            'name_ar'        =>'required',
            'name_en'        =>'required|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu',
            'sort'           =>'integer',
            'image'          =>'image|mimes:jpg,png,jpeg,gif,svg',
            'file'           =>'mimes:csv,txt,xlx,xls,pdf',
            // 'image'          =>'image|mimes:jpg,png,jpeg,gif,svg'.$req,
            // 'file'           =>'mimes:csv,txt,xlx,xls,pdf'.$req,
          ];
      }

    public function messages()
    {
        return $messages = [
        'name_ar.required'      =>   'اسم النشرة بالعربية مطلوب',
        'name_en.required'      =>   'اسم النشرة بالانجليزية مطلوب',
       // 'name_ar.unique'        =>    'اسم النشرة باللغه العربيه مُضاف مسبقا... قم بادخال اسم اخر ',
       // 'name_en.unique'        =>    'اسم النشرة باللغه الانجليزيه مُضاف مسبقا... قم بادخال اسم اخر ',
        'name_en.regex'         =>    'يجب ان يكون اسم النشرة باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',
        'sort.integer'          =>    'الترتيب يجب ان يكون رقم',
       // 'image.required'        =>   'الصورة مطلوبة',
        'image.mimes'           =>   'الصورة مطلوبة بالامتداداتjpg,png,jpeg,gif,svg',
        //'file.required'         =>   'الملف مطلوب',
        'file.mimes'            =>   'الملف مطلوب بالامتداداتjpg,png,jpeg,gif,svg',

        ];
    }
}




