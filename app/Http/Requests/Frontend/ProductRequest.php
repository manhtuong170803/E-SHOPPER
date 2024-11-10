<?php

namespace App\Http\Requests\Frontend;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric',
            'id_category' => 'required',
            'id_brand' => 'required',
            'img.*' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
            'detail' => 'required',
            'status' => 'required',
            'company' => 'nullable|string',
            'sale' => 'nullable|numeric|min:0|max:100',
        ];
   }
   public function messages(){
       return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'price.required' => 'Vui lòng nhập giá',
            'price.numeric' => 'Giá phải là số',
            'id_category.required' => 'Vui lòng chọn danh mục',
            'id_brand.required' => 'Vui lòng chọn thương hiệu',
            'img.*.image' => 'Tệp tải lên phải là hình ảnh',
            'img.*.mimes' => 'Hình ảnh phải là jpeg, png, jpg, hoặc gif',
            'img.*.max' => 'Kích thước hình ảnh không được vượt quá 1MB',
            'detail.required' => 'Vui lòng nhập chi tiết sản phẩm',
            'status.required' => 'Vui lòng chọn trạng thái sản phẩm',
            'company.required' => 'Vui lòng chọn company',
            'sale.numeric' => 'Giảm giá phải là số',
            'sale.min' => 'Giảm giá phải lớn hơn hoặc bằng 0',
            'sale.max' => 'Giảm giá không được vượt quá 100%',
       ];
   }  
}
