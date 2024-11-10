<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class MemberLoginRequest extends FormRequest
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
             'email' => 'required|email|unique:users,email,' . auth()->id(), 
             'password' => 'nullable|string|min:6', 
         ];
    }
    public function messages(){
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã được sử dụng',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ];
    } 
}
