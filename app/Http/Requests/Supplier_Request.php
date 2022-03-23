<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Supplier_Request extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
     
        'name_ar' => 'required|unique:suppliers,name_ar,'.$this->id,
        'name_en' => 'required|unique:suppliers,name_en,'.$this->id,
        'description_ar' => 'required',
        'description_en' => 'required',
        'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|dimensions:max_width=300,max_height=300'. $this->id,

        ];
    }
    public function messages()
    {
        return $messages = [
        'name_ar.required' =>'اسم المورد بالعربية مطلوب',
        'name_en.required' => 'اسم المورد بالانجليزية مطلوب',
        'description_ar.required' =>'وصف المورد بالعربية مطلوب',
        'description_en.required' =>'وصف المورد  بالانجليزية مطلوب',
        'name_ar.unique'=>'اسم المورد باللغه العربيه مُضاف مسبقا... قم بادخال اسم اخر ',
        'name_en.unique'=>'اسم المورد باللغه الانجليزيه مُضاف مسبقا... قم بادخال اسم اخر ',
        'logo.dimensions'=>'اقصى احداثيات يمكنك رفعها 300*300'
        ];
    }
}
