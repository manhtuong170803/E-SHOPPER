<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email,' . auth()->id(), 
             'password' => 'nullable|string|min:6', 
             'phone' => 'nullable|string|max:15', 
             'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
             'id_country' => 'nullable|string|max:255',
         ];
    }
    public function messages(){
        return [
            'name.required' => 'Vui lòng nhập name',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã được sử dụng',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'phone.max' => 'Số điện thoại không được quá 15 ký tự',
            'avatar.image' => 'Tệp tải lên phải là hình ảnh',
            'avatar.mimes' => 'Hình ảnh phải là jpeg, png, jpg, hoặc gif',
            'avatar.max' => 'Kích thước hình ảnh không được vượt quá 1MB',
            'id_country.max' => 'Tên quốc gia không được quá 255 ký tự',
        ];
    }    
        
}
