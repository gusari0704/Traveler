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
            'title.regex' => '使用禁止記号 #<>^;_ を消してください',
            'title.required' =>'タイトルを入力して下さい',
            'main.regex' => '使用禁止記号 #<>^;_ を消してください',
            'spot_name.regex' => '使用禁止記号 #<>^;_ を消してください',
            'spot_name.required' =>'名称・地名を入力して下さい',
            'lat.regex' => '使用禁止記号 #<>^;_ を消してください',
            'lat.required' =>'右側のマップで画像を撮った場所を検索するとアップロードできます',
            'lon.regex' => '使用禁止記号 #<>^;_ を消してください',
            'lon.required' =>'右側のマップで画像を撮った場所を検索するとアップロードできます',
            'address.regex' => '使用禁止記号 #<>^;_ を消してください',
            'address.required' =>'右側のマップで画像を撮った場所を検索するとアップロードできます',
        ];
    }
}
