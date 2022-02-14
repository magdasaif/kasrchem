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
        'email' => 'required|email|unique:branches,email,'.$this->id,
        //regex:/(01)[0-9]{9}/
        'phone' => 'required|numeric',
        'fax' => 'required|numeric',
        'status' => 'required',
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
        'status.required' =>'الحالة مطلوبة',
        'map_long.required' =>'قم بتحديد الموقع ع الخريطه',
        'map_lat.required' =>'قم بتحديد الموقع ع الخريطه',
        'email.required' => 'البريد الالكترونى مطلوب',
        'email.email' => 'تاكد من ادخال بريد الكترونى بالشكل المناسب',
        'phone.numeric' =>'تاكد من ان الهاتف رقم',
        'fax.numeric' =>'تاكد من ان الفاكس رقم',
        ];
    }
}
