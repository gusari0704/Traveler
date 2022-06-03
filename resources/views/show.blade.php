@extends('layouts.app')

@section('content')
<!--個別ページ-->
    <div class="content3">
        <p class="created">{{ $data->created_at }}</p>
        <h1>{{ $data->title }}</h1>
        <hr>
        <p>{!! nl2br($data->main)!!}</p>
        <!--もしpublic path(画像の一般公開用URL)に この記事のid番号.jpg が存在するなら、それを表示する-->
            @if(file_exists(public_path().'/storage/post_img/'. $data->id .'.jpg'))
                <a href="/storage/post_img/{{ $data->id }}.jpg" data-lightbox="abc" data-title="{{ $data->title }}"><img src="/storage/post_img/{{ $data->id }}.jpg"></a>
            @elseif(file_exists(public_path().'/storage/post_img/'. $data->id .'.jpeg'))
                <a href="/storage/post_img/{{ $data->id }}.jpeg" data-lightbox="abc" data-title="{{ $data->title }}"><img src="/storage/post_img/{{ $data->id }}.jpeg"></a>
            @elseif(file_exists(public_path().'/storage/post_img/'. $data->id .'.png'))
                <a href="/storage/post_img/{{ $data->id }}.png" data-lightbox="abc" data-title="{{ $data->title }}"><img src="/storage/post_img/{{ $data->id }}.png"></a>
            @elseif(file_exists(public_path().'/storage/post_img/'. $data->id .'.gif'))
                <a href="/storage/post_img/{{ $data->id }}.gif" data-lightbox="abc" data-title="{{ $data->title }}"><img src="/storage/post_img/{{ $data->id }}.gif"></a>
            @endif
        
    </div>

        @foreach($coments as $coment)
        <div class="content">
        <hr>

        <p>{{ $coment->text }}</p>
        </div>
        @if($user_id == $coment->user_id)
            <form action="{{ route('coment.destroy', $coment->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit">コメントを削除</button>
            </form>
            <p>
                <a href="{{ route('coment.edit', $coment->id) }}">
                  ［編集］
                </a>
            </p>
        @endif
        @endforeach

        <form action="/comentform" method="post">
            @csrf
            <p>&nbsp;</p>
            <p>コメント</p>
            <textarea name="text" cols="40" rows="5" value={{old('text')}}></textarea>
            @error('text')
            <p class="perror"><span style="color:red;">{{ $message }}</span></p>
            @enderror
            
            <input type="hidden" name="form_id" value="{{ $data->id }}">
            <p>&nbsp;</p>
            <input type="submit" class="submitbtn">
        </form>
@endsection