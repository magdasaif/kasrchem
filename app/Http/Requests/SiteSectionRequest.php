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

        
            if(isset($this->id))
            {
                $cond=decrypt($this->id);
                $req='';
            }
            else
            {
                $cond='';
                $req='|required';
            }
            return [
            'name_ar'  => 'required|unique:site_sections,name_ar,'.$cond,
            'name_en'  => 'required|regex:/^[a-zA-Z_@.\s\#&+(){}:,% ^ =" ® © >< $ -][a-zA-Z0-9_@.\s\#&+(){}: ,% ^ = " ® ©> <$ -]+$/uu|unique:site_sections,name_en,'.$cond,
            'status'   => 'required',
            'sort'     =>'required|integer',
            'image'    =>'mimes:jpg,png,jpeg,gif,svg|image'.$req,
        ];
    }
        public function messages()
        {
            return $messages = [
                'name_ar.required'     =>"اسم القسم بالعربية مطلوب ",
                'name_ar.unique'        => "اسم القسم بالعربية مسجل مسبقا ...قم بادخال اسم اخر",
                'name_en.required' =>"اسم القسم بالانجليزىة مطلوب ",
                'name_en.unique'   =>"اسم القسم بالانجليزىة مسجل مسبقا ...قم بادخال اسم اخر",
                'name_en.regex' => '  يجب ان يكون اسم القسم  باللغة الانجليزية وايضا لا يكون ارقام فقط وان لا يبدأ برقم',
                'status.required'      => 'الحالة مطلوبة',
                'priority.required'     => 'الاولوية مطلوبة ',
                'image.required'        => 'الصورة مطلوبة ',
                'image.mimes'           => 'الصورة يجب ان تكون بالامتدات التالية',
                'sort.integer'          =>    'الترتيب يجب ان يكون رقم',
            ];
        }
}
