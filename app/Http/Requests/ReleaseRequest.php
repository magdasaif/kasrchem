<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReleaseRequest extends FormRequest
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
          'title_ar' => 'required',
          'title_en' => 'required',
           'status' => 'required',
          
        ];
    }
    public function messages()
    {
        return $messages = [
             'title_ar.required' =>'اسم النشرة بالعربية مطلوبة',
             'title_en.required' => '  اسم النشرة  بالانجليزية مطلوبة',
             'status.required' =>'الحالة مطلوبة',
        ];
    }
}
