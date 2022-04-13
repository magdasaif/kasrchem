<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
        if(isset($this->id)){$cond=decrypt($this->id);}else{$cond='';}
        return [
     
        'name_ar' => 'required|unique:branches,name_ar,'.$cond,
        'name_en' => 'required|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu|unique:branches,name_en,'.$cond,
        'address_ar' => 'required',
        'address_en' => 'required',
        'email' => 'nullable|email',
       // 'email' => 'nullable|email|unique:branches,email,'.$this->id,
       'phone' => 'nullable|regex:/(0)[0-9]{9}/|min:10|max:14',
       //'fax' => 'nullable|min:11|numeric',
       'fax' => 'nullable|regex:/(0)[0-9]{9}/|min:10|max:14',
        'longitude' => 'required',
        'latitude' => 'required',  
               
        ];
    }
    public function messages()
    {
        return $messages = [
        'name_ar.required' =>'اسم الفرع بالعربية مطلوب',
        'name_ar.unique' =>'اسم الفرع بالعربية مسجل مسبقا ...قم بادخال اسم اخر',
        'name_en.required' => 'اسم الفرع بالانجليزية مطلوب',
        'name_en.unique' =>'اسم الفرع بالانجليزية مسجل مسبقا ...قم بادخال اسم اخر',
        'name_en.regex' => '  يجب ان يكون اسم الفرع  باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',

        'address_ar.required' =>'عنوان الفرع بالعربية مطلوب',
        'address_en.required' =>'عنوان الفرع بالانجليزية مطلوب',
        'longitude.required' =>'قم بتحديد الموقع ع الخريطه',
        'latitude.required' =>'قم بتحديد الموقع ع الخريطه',
         'email.email'=>'ادخل الميل بالشكل المناسب',
       // 'email.unique'=>'هذا الميل موجو مسبقا',
        'phone.regex' =>'  تاكد من ان الهاتـف بالشكل المناسب بحيث يبدا ب 0 ',
        'phone.min' =>'تاكد من ان الهاتـف بالشكل المناسب بحيث ألا  يقل عن 10 ارقام',
        'phone.max' =>' تاكد من ان الهاتـف بالشكل المناسب بحيث لا يزيد عن14رقم',
        //'fax.numeric' =>'تاكد من ان الفاكس رقم',
       'fax.regex' =>'  تاكد من ان الفاكس بالشكل المناسب بحيث يبدا ب 0 ',
       'fax.min' =>'تاكد من ان الفاكس بالشكل المناسب بحيث ألا يقل عن 10 ارقام',
       'fax.max' =>' تاكد من ان الفاكس بالشكل المناسب بحيث لا يزيد عن14رقم',
        ];
    }
}
