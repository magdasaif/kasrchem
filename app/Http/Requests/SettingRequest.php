<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
                'site_logo' => 'image|mimes:PNG,png,svg|dimensions:max_width=300,max_height=300',
              ];
    }
    public function messages()
    {
        return $messages = [
            'site_logo.mimes'=>'تاكد من اختيار صوره من نوع png او svg',
            'site_logo.dimensions'=>'اقصى احداثيات يمكنك رفعها 300*300',
        
        ];
    }
}
