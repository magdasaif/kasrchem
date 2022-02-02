<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest
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
     
        'name' => 'required',
        'link' => 'required',
        'icon' => 'required', 
        'status' => 'required',
          
        ];
    }
    public function messages()
    {
        return $messages = [
        'name.required' =>'اسم الرابط مطلوب',
        'link.required' =>'لينك الرابط مطلوب',
        'icon.required' =>' الايقون مطلوب',
       
        ];
    }
}
