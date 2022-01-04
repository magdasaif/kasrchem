<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCatergory3Request extends FormRequest
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
            'subname_ar'=>'required',
            'subname_en'=>'required',
            'status'=>'required',
            
        ];
    }
}
