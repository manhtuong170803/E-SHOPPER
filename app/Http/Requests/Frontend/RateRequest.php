<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id_blog' => 'required|exists:blog,id',
            'rate' => 'required|integer|min:1|max:5',
        ];
   }
   public function messages(){
       return [
           'id_blog.required' => 'Vui lòng chọn một bài viết.',
            'id_blog.exists' => 'Bài viết không tồn tại.',
            'rate.required' => 'Vui lòng chọn số sao đánh giá.',
            'rate.integer' => 'Số sao đánh giá phải là số nguyên.',
            'rate.min' => 'Số sao đánh giá phải ít nhất là 1.',
            'rate.max' => 'Số sao đánh giá tối đa là 5.',
       ];
   }  
}
