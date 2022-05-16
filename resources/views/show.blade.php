@extends('layouts.app')

@section('content')
<!--個別ページ-->
    <div class="content3">
        <p class="created">{{$data->created_at}}</p>
        <h1>{{$data->title}}</h1>
        <hr>
        <p>{!! nl2br($data->main)!!}</p>
        <!--もしpublic path(画像の一般公開用URL)に この記事のid番号.jpg が存在するなら、それを表示する-->
            @if(file_exists(public_path().'/storage/post_img/'. $data->id .'.jpg'))
                <img src="/storage/post_img/{{ $data->id }}.jpg">
            @elseif(file_exists(public_path().'/storage/post_img/'. $data->id .'.jpeg'))
                <img src="/storage/post_img/{{ $data->id }}.jpeg">
            @elseif(file_exists(public_path().'/storage/post_img/'. $data->id .'.png'))
                <img src="/storage/post_img/{{ $data->id }}.png">
            @elseif(file_exists(public_path().'/storage/post_img/'. $data->id .'.gif'))
                <img src="/storage/post_img/{{ $data->id }}.gif">
            @endif
    </div>
        @foreach($coments as $coment)
        <div class="content">
        <hr>
        <p>{{$coment->text}}</p>
        </div>
        @endforeach

        <form action="/comentform" method="post">
            @csrf
            <p>&nbsp;</p>
            <p>コメント</p>
            <textarea name="text" cols="40" rows="10"></textarea>
            <input type="hidden" name="form_id" value="{{ $data->id }}">
            <p>&nbsp;</p>
            <input type="submit" class="submitbtn">
        </form>
@endsection