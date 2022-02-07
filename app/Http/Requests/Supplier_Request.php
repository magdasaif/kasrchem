<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Supplier_Request extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
     
        'name_ar' => 'required',
        'name_en' => 'required',
        'description_ar' => 'required',
        'description_en' => 'required',
          
        ];
    }
    public function messages()
    {
        return $messages = [
        'name_ar.required' =>'اسم المورد بالعربية مطلوب',
        'name_en.required' => 'اسم المورد بالانجليزية مطلوب',
        'description_ar.required' =>'وصف المورد بالعربية مطلوب',
        'description_en.required' =>'وصف المورد  بالانجليزية مطلوب',
        ];
    }
}
