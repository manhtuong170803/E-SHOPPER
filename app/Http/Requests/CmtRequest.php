<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CmtRequest extends FormRequest
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
            'cmt' => 'required|string',
            'id_blog' => 'required|integer',
            'level' => 'required|integer',
            
        ];
   }
   public function messages(){
       return [
           'cmt.required' => 'Vui lòng nhập bình luận ',
       ];
   }
}
