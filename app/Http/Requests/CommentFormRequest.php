<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 必須、空欄OK、特殊記号禁止
            'text' => 'required|nullable|regex:/^[^#<>^;_]*$/',

        ];
    }
    
    public function messages()
    {
        return[
            'text.regex' => '使用禁止記号#<>^;_を消してください',
            'text.required' =>'必須 (required)',
        ];
    }
}
