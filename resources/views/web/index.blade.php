@extends('layouts.app')

@section('content')
<div class="row">

    <div class="col-9">
        <div class="row">
            <div class="col-8">
                @foreach($data as $datas)
                  <div class="content">
                    <h1><a href="/show/{{$datas->id}}">{{$datas->title}}</a></h1>
                    <hr>
                    <p>{!! nl2br($datas->main) !!}</p>
                    <!--もしpublic path(画像の一般公開用URL)に この記事のid番号.jpg が存在するなら、それを表示する-->
                        @if(file_exists(public_path().'/storage/post_img/'. $datas->id .'.jpg'))
                            <img src="/storage/post_img/{{ $datas->id }}.jpg">
                        @elseif(file_exists(public_path().'/storage/post_img/'. $datas->id .'.jpeg'))
                            <img src="/storage/post_img/{{ $datas->id }}.jpeg">
                        @elseif(file_exists(public_path().'/storage/post_img/'. $datas->id .'.png'))
                            <img src="/storage/post_img/{{ $datas->id }}.png">
                        @elseif(file_exists(public_path().'/storage/post_img/'. $datas->id .'.gif'))
                            <img src="/storage/post_img/{{ $datas->id }}.gif">
                        @endif
                  </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
