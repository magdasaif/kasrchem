<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
                'photos.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
              ];
    }
    public function messages()
    {
        return $messages = [
           // 'photos.*.dimensions'=>'الأبعاد [يجب أن يكون العرض بين (850 و 1200) ، ويجب أن يكون الارتفاع بين (315 و 600)]',        
        ];
    }
}
