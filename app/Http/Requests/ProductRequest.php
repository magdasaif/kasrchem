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
           
            //exists:main_categories,id
            //|not_in:0
            // 'main_cate_id' => 'required',
            // 'sub2' => 'required',
            // 'sub3' => 'required',
            // 'sub4' => 'required',

           
            'name_ar'=>'required|unique:products,name_ar,'.$this->id,
            'name_en'=>'required|unique:products,name_en,'.$this->id,
            'desc_ar'=>'required',
            'desc_en'=>'required',
            'sort'=>'integer',

            // 'code'=>'required|unique:products',
            // 'name_ar'=>'required|unique:products',
            // 'name_en'=>'required|unique:products',
            //'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

            
            //'code'=>'required|unique:products,code,'.$this->id,
            //`price'=>'required',
            //'amount'=>'required',
            //'amount'=>'required|integer',
            //'min_amount'=>'required|integer',
            //'max_amount'=>'required|integer',
            //'shipped_weight'=>'required',

            // 'List_Classes.*.weight_ar' => 'required',
            // 'List_Classes.*.value_ar' => 'required',
            // 'List_Classes.*.weight_en' => 'required',
            // 'List_Classes.*.value_en' => 'required',
        ];
    }
    public function messages()
    {
        return [
            // 'List_Classes.*.weight_ar.required' => 'تاكد من ادخال خاصيه المنتج بالعربيه',
            // 'List_Classes.*.value_ar.required' => 'تاكد من ادخال قيمه المنتج بالعربيه',
            // 'List_Classes.*.weight_en.required' => 'تاكد من ادخال خاصيه المنتج بالانجليزيه',
            // 'List_Classes.*.value_en.required' => 'تاكد من ادخال قيمه المنتج بالانجليزيه',
            // 'main_cate_id.required'=>'تاكد من اختيار تصنيف رئيسى',
            // 'sub2.required'=>'تاكد من اختيار تصنيف فرعى',
            // 'sub3.required'=>'تاكد من اختيار نوع رئيسى',
            // 'sub4.required'=>'تاكد من اختيار نوع فرعى',
        ];
    }
}
