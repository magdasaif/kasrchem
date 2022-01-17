<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        //     'main_category' => 'required',
        //     'sub2' => 'required',
        //     'sub3' => 'required',
        //     'sub4' => 'required',
        //     'title_ar' => 'required',
        //     'title_en' => 'required',
        //    // 'content_ar' => 'required',
        //    // 'content_en' => 'required',
        //     'status' => 'required',
          
        ];
    }
    public function messages()
    {
        return $messages = [
          
            //  'main_category.required' =>' التصنيف الرئيسى مطلوب',
            //  'sub2.required' =>' التصنيف الفرعى مطلوب',
            //  'sub3.required' =>' النوع مطلوب',
            //  'sub4.required' =>' النوع الفرعى مطلوب',
            //  'title_ar.required' =>'عنوان المقال بالعربية مطلوب',
            //  'title_en.required' => 'عنوان المقال بالانجليزية مطلوب',
            //  //'content_ar.required' =>'محتوى المقال بالعربية مطلوب',
            // // 'content_en.required' =>'محتوى المقال بالانجليزية مطلوب',
            //  'status.required' =>'الحالة مطلوبة',
        ];
    }
}
