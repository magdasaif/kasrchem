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
        if(isset($this->id)){
            $cond=decrypt($this->id);
            $req='';
        }else{
            $cond='';
            $req='|required';
        }
        
        return [
          'name_ar'      => 'required|unique:photo_gallerys,name_ar,'.$cond,
          'name_en'      => 'required|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu|unique:photo_gallerys,name_en,'.$cond,
           'status'      => 'required',
           'sort'        =>'integer',
           'image'       =>'image|mimes:jpg,png,jpeg,gif,svg|max:2048'. $req,
          
        ];
    }
    public function messages()
    {
        return $messages = [
             'name_ar.required'         =>'اسم المعرض بالعربية مطلوب',
             'name_en.required'         => '  اسم المعرض  بالانجليزية مطلوب',
             'name_en.regex'            => '  يجب ان يكون اسم المعرض باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',
             'name_ar.unique'           =>'اسم المعرض باللغه العربيه مُضاف مسبقا... قم بادخال اسم اخر ',
             'name_en.unique'           =>'اسم المعرض باللغه الانجليزيه مُضاف مسبقا... قم بادخال اسم اخر ',
             
             'status.required'          =>'الحالة مطلوبة',
             'image.required'           =>'تاكد من ادخال صوره صحيحه',
             'sort.integer'             =>'الترتيب يجب ان يكون رقم',
        ];
    }
}
