<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'code'=>'required|unique:products',
            'name_ar'=>'required|unique:products',
            'name_en'=>'required|unique:products',
            'price'=>'required',
            'desc_ar'=>'required',
            'desc_en'=>'required',
            'amount'=>'required',
            'min_amount'=>'required',
            'max_amount'=>'required',
            'image'=>'required',
            'shipped_weight'=>'required',
        ];
    }
}
