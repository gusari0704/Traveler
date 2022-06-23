@extends('layouts.app')

@section('content')
<header id="header">
  <div class="inner">
    <ul class="navi">
          <li class="textlink textlink02"><a href="{{route('mypage.form')}}">投稿</a></li>
          <li class="textlink02a"><a href="{{route('mypage.history')}}">投稿履歴</a></li>
          <li class="textlink textlink02"><a href="">お気に入り</a></li>
          <li class="textlink textlink02"><a href="{{route('mypage.edit')}}">会員情報</a></li>
    </ul>
  </div>
</header>
<div class="wrapper">
    <div class="form_container">
    @foreach($data as $datas)
    <div>
    <p class="overflow-ellipsis">{{ $datas->title }}</p>
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
        <form  style="margin:15px;" action="{{ route('form.destroy', $datas->id) }}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">削除</button>
        </form>
        <hr>
    </div>
    @endforeach
    </div>
</div>
        </div>
    </div>
</div>
@endsection
