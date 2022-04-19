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
        if(isset($this->id)){
            $req='';
        }else{
            $req='|required';
        }
        return [
            'status' => 'required',
            'sort' => 'required',
           'image' => 'image|mimes:jpeg,png,jpg,gif,svg'.$req,
        //    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1200,max_height=600,min_width=850,min_height=315'.$req,
        ];
    }
    public function messages()
    {
        return $messages = [
          
            'sort.required' => 'الترتيب مطلوبة ',
              'image.required' => 'الصورة مطلوبة ',
              'image.image' => 'يجب ان يكون الملف المرفق صورة',
             // 'image.dimensions' => 'أبعاد الصوره [يجب أن يكون العرض بين (850 و 1200) ، ويجب أن يكون الارتفاع بين (315 و 600)]',
        ];
    }
}
