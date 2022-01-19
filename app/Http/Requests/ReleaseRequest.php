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
             'title_ar.required' =>'عنوان الفيديو بالعربية مطلوب',
             'title_en.required' => 'عنوان الفيديو بالانجليزية مطلوب',
             'status.required' =>'الحالة مطلوبة',
        ];
    }
}
