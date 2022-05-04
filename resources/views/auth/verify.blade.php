@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h3 class="text-center">会員登録ありがとうございます！</h3>
            <hr>
            <p class="">
                現在、仮会員の状態です。
                ただいま、ご入力頂いたメールアドレス宛に、ご本人様確認用のメールをお送りしました。<br>
            </p>
            <p class="">
                メール本文内のURLをクリックすると本会員登録が完了となります。
            </p>
            <div class="text-center">
                <a href="/" class="btn samazon-submit-button w-50 text-white">トップページへ</a>
            </div>
        </div>
    </div>
</div>
@endsection