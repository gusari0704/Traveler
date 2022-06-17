<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 必須、空欄OK、特殊記号禁止
            'title' => 'required|nullable|regex:/^[^#<>^;_]*$/',
            'main' => 'nullable|regex:/^[^#<>^;_]*$/',

        ];
    }
    
    public function messages()
    {
        return[
            'title.regex' => '使用禁止記号#<>^;_を消してください',
            'title.required' =>'必須 (required)',
            'main.regex' => '使用禁止記号#<>^;_を消してください',
        ];
    }
}
