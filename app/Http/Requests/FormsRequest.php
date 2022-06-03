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
            // 空欄OK、特殊記号禁止
            'title' => 'nullable|regex:/^[^#<>^;_]*$/',
            // 必須、空欄OK、特殊記号禁止
            'text' => 'required|nullable|regex:/^[^#<>^;_]*$/',
            // 必須、Email形式のみOK
            'email' => 'required|email',
            // 必須、数字と+と半角空欄のみOK
            'phone' => 'required|regex:/^[0-9 +]*$/'
        ];
    }
    
    public function messages()
    {
        return[
            'title.regex' => '使用禁止記号#<>^;_を消してください',
            'title.required' =>'必須 (required)',
            'main.regex' => '使用禁止記号#<>^;_を消してください',
            'text.regex' => '使用禁止記号#<>^;_を消してください',
            'text.required' =>'必須 (required)',
            'email.required' =>'必須 (required)',
            'email.email' =>'正しいEmail形式で入力ください',
            'phone.required' =>'必須 (required)',
            'phone.regex' =>'使えるのは、数字と+のみです'
        ];
    }
}
