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
           //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
        ];
    }
    public function messages()
    {
        return $messages = [
          
            'priority.required' => 'الاولوية مطلوبة ',
              'image.required' => 'الصورة مطلوبة ',
        ];
    }
}
