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
            'spot_name' => 'required|nullable|regex:/^[^#<>^;_]*$/',
            'lat' => 'required|nullable|regex:/^[^#<>^;_]*$/',
            'lon' => 'required|nullable|regex:/^[^#<>^;_]*$/',
            'address' => 'required|nullable|regex:/^[^#<>^;_]*$/',
        ];
    }
    
    public function messages()
    {
        return[
            'title.regex' => '使用禁止記号#<>^;_を消してください',
            'title.required' =>'タイトルを入力して下さい',
            'main.regex' => '使用禁止記号#<>^;_を消してください',
            'spot_name.regex' => '使用禁止記号#<>^;_を消してください',
            'spot_name.required' =>'名称・地名などを入力して下さい',
            'lat.regex' => '使用禁止記号#<>^;_を消してください',
            'lat.required' =>'画像を撮った場所を、右側のマップで検索してからアップロードして下さい',
            'lon.regex' => '使用禁止記号#<>^;_を消してください',
            'lon.required' =>'画像を撮った場所を、右側のマップで検索してからアップロードして下さい',
            'address.regex' => '使用禁止記号#<>^;_を消してください',
            'address.required' =>'画像を撮った場所を、右側のマップで検索してからアップロードして下さい',
        ];
    }
}
