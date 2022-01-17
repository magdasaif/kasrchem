<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
        return [
          'title_ar' => 'required',
          'title_en' => 'required',
            'link' => 'required',
           'status' => 'required',
          
        ];
    }
    public function messages()
    {
        return $messages = [
             'title_ar.required' =>'عنوان الفيديو بالعربية مطلوب',
             'title_en.required' => 'عنوان الفيديو بالانجليزية مطلوب',
             'link.required' =>'رابط الفيديو مطلوب',
             'status.required' =>'الحالة مطلوبة',
        ];
    }
}
