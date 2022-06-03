@extends('layouts.app')

@section('content')
<div id="top_block">
    <div class="top_content">
        <div class="top">
            <img src="/storage/image/top_ground.jpg">
            <form action="/" method="GET">
                <input type="text" name="keyword" value="{{ $keyword }}">
                <input type="submit" value="検索">
            </form>
        </div>
    </div>
</div>
<hr>
<h4>みんなの旅ログ</h4>
<hr>
<div class="form_container">
    @foreach($data as $datas)
    <!--もしpublic path(画像の一般公開用URL)に この記事のid番号.jpg が存在するなら、それを表示する-->
        @if(file_exists(public_path().'/storage/post_img/'. $datas->id .'.jpg'))
            <div class="form_img"><a href="/show/{{ $datas->id }}"><img src="/storage/post_img/{{ $datas->id }}.jpg"></a></div>
        @elseif(file_exists(public_path().'/storage/post_img/'. $datas->id .'.jpeg'))
            <div class="form_img"><a href="/show/{{ $datas->id }}"><img src="/storage/post_img/{{ $datas->id }}.jpeg"></a></div>
        @elseif(file_exists(public_path().'/storage/post_img/'. $datas->id .'.png'))
            <div class="form_img"><a href="/show/{{ $datas->id }}"><img src="/storage/post_img/{{ $datas->id }}.png"></a></div>
        @elseif(file_exists(public_path().'/storage/post_img/'. $datas->id .'.gif'))
            <div class="form_img"><a href="/show/{{ $datas->id }}"><img src="/storage/post_img/{{ $datas->id }}.gif"></a></div>
        @endif
        @endforeach
</div>
@endsection
