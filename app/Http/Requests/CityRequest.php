<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
     
        'title_ar' => 'required',
        'title_en' => 'required',
        'charge_spend' => 'required',
        'status' => 'required',
          
        ];
    }
    public function messages()
    {
        return $messages = [
        'title_ar.required' =>'اسم المدينة بالعربية مطلوب',
        'title_en.required' => 'اسم المدينة بالانجليزية مطلوب',
        'charge_spend.required' =>'مصاريف الشحن مطلوبة',
        'status.required' =>'الحالة مطلوبة',
        ];
    }
}
