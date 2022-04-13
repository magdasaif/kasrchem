<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use  Illuminate\Validation\Validator;

class PartnerRequest extends FormRequest
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
            'name_ar'        =>'required|unique:partners,name_ar,'.$cond,
            'name_en'        =>'required|unique:partners,name_en,'.$cond.'|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu',
            'sort'           =>'integer',
            'external_link'  =>'required|url',
            'image'          =>'image|mimes:jpg,png,jpeg,gif,svg'.$req,
        ];
    }
    public function messages()
    {
        return $messages = [
        'name_ar.required'      =>'اسم الشريك بالعربية مطلوب',
        'name_en.required'      => 'اسم الشريك بالانجليزية مطلوب',
        'name_ar.unique'           =>'اسم الشريك باللغه العربيه مُضاف مسبقا... قم بادخال اسم اخر ',
        'name_en.unique'           =>'اسم الشريك باللغه الانجليزيه مُضاف مسبقا... قم بادخال اسم اخر ',
        'name_en.regex'         => '  يجب ان يكون اسم الشريك باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',
        'image.required'        =>'تاكد من ادخال صوره صحيحه',
        'sort.integer'          =>'الترتيب يجب ان يكون رقم',
        'external_link.required'=>'تاكد من ادخال لينك ',
        'external_link.url'     =>'تاكد من ادخال لينك صحيح',
        ];
    }
}
