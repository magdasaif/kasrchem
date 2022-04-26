<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use  Illuminate\Validation\Validator;

class new_supplierRequest extends FormRequest
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
        if(isset($this->id)){
            $cond=decrypt($this->id);
            $req='';
        }else{
            $cond='';
            $req='|required';
        }
        
        return [
            'name_ar'        =>'required|unique:suppliers,name_ar,'.$cond,
            'name_en'        =>'required|unique:suppliers,name_en,'.$cond.'|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu',
            'sort'           =>'integer',
            'image'          =>'image|mimes:jpg,png,jpeg,gif,svg'.$req,
        ];
    }
    public function messages()
    {
        return $messages = [
        'name_ar.required'      =>'اسم المورد بالعربية مطلوب',
        'name_en.required'      => 'اسم المورد بالانجليزية مطلوب',
        'name_ar.unique'           =>'اسم المورد باللغه العربيه مُضاف مسبقا... قم بادخال اسم اخر ',
        'name_en.unique'           =>'اسم المورد باللغه الانجليزيه مُضاف مسبقا... قم بادخال اسم اخر ',
        'name_en.regex'         => '  يجب ان يكون اسم المورد باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',
        'image.required'        =>'تاكد من ادخال صوره صحيحه',
        'sort.integer'          =>'الترتيب يجب ان يكون رقم',
        ];
    }
}
