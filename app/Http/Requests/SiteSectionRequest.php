<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteSectionRequest extends FormRequest
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
        
        return $rules = [
            'site_name_ar' => 'required',
            'site_name_en' => 'required',
            'statues' => 'required',
           
            'image' => 'required|mimes:jpeg,bmp,png',
        ];
    }
        public function messages()
        {
            return $messages = [
                'site_name_ar.required' =>"اسم القسم بالعربى مطلوب ",
                'site_name_ar.unique' => "هذا الاسم مسجل من قبل",
                'site_name_en.required' =>"اسم القسم بالانجليزى مطلوب ",
                'site_name_en.unique' => "هذا الاسم مسجل من قبل",
                'statues.required' => 'الحالة مطلوبة',
                'image.required' => 'الصورة مطلوبة ',
            ];    
        }
}
