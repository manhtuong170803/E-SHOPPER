<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'required'=>':attribute Không được để trống',
            'email.email' => ':attribute sai định dạng'
        ];
    } 
}
