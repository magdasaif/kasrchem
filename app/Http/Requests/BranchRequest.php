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
        return [
     
        'name_ar' => 'required|unique:branches,name_ar,'.$this->id,
        'name_en' => 'required|unique:branches,name_en,'.$this->id,
        'address_ar' => 'required',
        'address_en' => 'required',
        'email' => 'nullable|email',
       // 'email' => 'nullable|email|unique:branches,email,'.$this->id,
       'phone' => 'nullable|regex:/(0)[0-9]{9}/|min:10|max:14',
       //'fax' => 'nullable|min:11|numeric',
       'fax' => 'nullable|regex:/(0)[0-9]{9}/|min:10|max:14',
        'map_long' => 'required',
        'map_lat' => 'required',         
        ];
    }
    public function messages()
    {
        return $messages = [
        'name_ar.required' =>'اسم الفرع بالعربية مطلوب',
        'name_en.required' => 'اسم الفرع بالانجليزية مطلوب',
        'address_ar.required' =>'عنوان الفرع بالعربية مطلوب',
        'address_en.required' =>'عنوان الفرع بالانجليزية مطلوب',
        'map_long.required' =>'قم بتحديد الموقع ع الخريطه',
        'map_lat.required' =>'قم بتحديد الموقع ع الخريطه',
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
