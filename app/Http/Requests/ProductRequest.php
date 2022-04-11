<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if(isset($this->id)){$cond=decrypt($this->id);}else{$cond='';}
        return [ 
            // 'supplier_id'   =>'required|exists:suppliers,id',
            'site_id'       =>'required|exists:site_sections,id',
            'name_ar'       =>'required|unique:products,name_ar,'.$cond,
            'name_en'       =>'required|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu|unique:products,name_en,'.$cond,
            'description_ar'=>'required',
            'description_en'=>'required',
            'sort'          =>'integer',
            'image'         =>'image|mimes:jpg,png,jpeg,gif,svg|required,'. $cond,
        ];
    }
    public function messages()
    {
        return [
            // 'supplier_id.required'     =>'تاكد من اختيار مورد',
            // 'supplier_id.exists'       =>' تاكد من اختيار مورد من قائمه الموردين',
            'site_id.required'         =>'تاكد من اختيار قسم',
            'site_id.exists'           =>' تاكد من اختيار قسم من قائمه الاقسام',
            'name_ar.required'         =>'تاكد من ادخال اسم المنتج باللغه العربيه ',
            'name_en.required'         =>'تاكد من ادخال اسم المنتج باللغه الانجليزيه ',
            'name_en.regex'            => '  يجب ان يكون اسم المنتج باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',
            'name_ar.unique'           =>'اسم المنتج باللغه العربيه مُضاف مسبقا... قم بادخال اسم اخر ',
            'name_en.unique'           =>'اسم المنتج باللغه الانجليزيه مُضاف مسبقا... قم بادخال اسم اخر ',
            'description_ar.required'  =>'الوصف باللغه العربيه مطلوب',
            'description_en.required'  =>'الوصف باللغه الانجليزيه مطلوب',
            'image.required'           =>'تاكد من ادخال صوره صحيحه',
            'sort.integer'             =>'الترتيب يجب ان يكون رقم',
        ];
    }
}
