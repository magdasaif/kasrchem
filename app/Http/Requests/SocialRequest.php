<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if(isset($this->id)){$cond=decrypt($this->id);}else{$cond='';}
        return [
     
        'name'   => 'required|unique:socials,name,'.$cond,
        'link'   => 'required|url',
        'icon'   => 'required', 
        'status' => 'required',
          
        ];
    }
    public function messages()
    {
        return $messages = [
        'name.required' =>'اسم الرابط مطلوب',
        'name.unique' =>'اسم الرابط مسجل مسبقا ...قم بادخال اسم اخر',
        'link.required' =>' الرابط مطلوب',
        'link.url' =>' قم بادخال الرابط بالشكل المناسب',
        'icon.required' =>' الايقون مطلوب',
        'status.required' =>' الحالة مطلوبة',
       
        ];
    }
}
