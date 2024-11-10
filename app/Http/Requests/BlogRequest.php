<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'content' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập title',
            'image.required' => 'Vui lòng nhập image',
            'description.required' => 'Vui lòng nhập description',
            'content.required' => 'Vui lòng nhập content',
        ];
    }
}
