<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'status' => 'required',
            'priority' => 'required',
           //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|required|dimensions:max_width=1200,max_height=600,min_width=850,min_height=315',
        ];
    }
    public function messages()
    {
        return $messages = [
          
            'priority.required' => 'الاولوية مطلوبة ',
              'image.required' => 'الصورة مطلوبة ',
              'image.image' => 'يجب ان يكون الملف المرفق صورة',
        ];
    }
}
