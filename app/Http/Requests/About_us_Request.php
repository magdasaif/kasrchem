<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class About_us_Request extends FormRequest
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
                 'title_en' =>'required',
                 'mission_ar'=>'required',
                 'mission_en'=>'required',
                 'vision_ar'=>'required',
                 'vision_en'=>'required',
                 'goal_ar'=>'required',
                 'goal_en'=>'required',
                ];
    }
    public function messages()
    {
        return $messages = [
        'title_ar.required' =>'اسم الموقع مطلوب',
        'title_en.required' => 'اسم الموقع  بالانجليزية مطلوب',
        'mission_ar.required' =>'الرسالة بالعربية مطلوب',
        'mission_en.required' =>'الرسالة بالانجليزية مطلوب',
        'vision_ar.required' =>'الرؤية بالعربية مطلوب',
        'vision_en.required' =>'الرؤية بالانجليزية مطلوب',
         'goal_ar.required' =>'الهدف بالعربية مطلوب',
         'goal_en.required' =>'الهدف بالانجليزية مطلوب',

        
        ];
    }
}
