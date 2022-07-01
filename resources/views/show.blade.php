@extends('layouts.app')

@section('content')
<div class="wrapper02">
<!--個別ページ-->
<main class="content_flex">
    <div class="content3">
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
                <div id='map'></div>
    </div>
    <div class="content3_grid">
        <!--ブックマーク-->
         @if($data->isFavoritedBy(Auth::user()))
         <a href="/{{ $data->id }}/favorite" class="btn samazon-favorite-button text-favorite w-100">
             <i class="fa fa-heart"></i>
             お気に入り解除
         </a>
         @else
         <a href="/{{ $data->id }}/favorite" class="btn samazon-favorite-button text-favorite w-100">
             <i class="fa fa-heart"></i>
             お気に入り
         </a>
         @endif
        <p class="created">{{ $data->created_at }}</p>
        <h2>{{ $data->title }}</h2>
        <hr>
        <p style="font-size:15px; margin-bottom:50px;">{!! nl2br($data->main)!!}</p>

        <!--投稿へのコメント一覧-->
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
        
        <!--コメント機能-->
        <form action="/comentform" method="post">
            @csrf
            <p>&nbsp;</p>
            <textarea name="text" cols="35" rows="3" value={{old('text')}} type="text" placeholder="コメントを入力"></textarea>
            @error('text')
            <p class="perror"><span style="color:red;">{{ $message }}</span></p>
            @enderror
            
            <input type="hidden" name="form_id" value="{{ $data->id }}">
            <p>&nbsp;</p>
            <input type="submit" class="submitbtn">
        </form>
    </div>
</main>
        <!--写真の位置情報-->
        <script>
            $(function(){
              mapboxgl.accessToken = 'pk.eyJ1IjoiZ3VzYXJpIiwiYSI6ImNsM3lpMTk3cjNmZnEza2w4OWw5OXBrMzYifQ.DBDiekWcs1_ccUjJg9cGEQ';
              const map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/gusari/cl48qv04o000015o60xusz3pz', // マップのスタイル（デザイン）
                center: [{{ $data->lon }}, {{ $data->lat }}], // 初期に表示する地図の緯度経度 [経度、緯度]
                zoom: 14 // 初期に表示する地図のズームレベル
              });
                map.on('load', function () {
                // マーカー追加
                const Marker = new mapboxgl.Marker({
                // マーカーの色指定
                color: '#e50112'
                })
                .setLngLat([{{ $data->lon }}, {{ $data->lat }}])
                .addTo(map);
                });
                // コントロール関係表示
                map.addControl(new mapboxgl.NavigationControl());
                map.addControl(new mapboxgl.FullscreenControl());
            });
        </script>
        


<!--
<a href="https://twitter.com/intent/tweet?url=【共有するURL】&hashtags=【ハッシュタグ（複数あるときはカンマ区切り）】" rel="nofollow" target="blank_">
  Twiiterでシェアする
</a>
                // ポップアップ
                const popup = new mapboxgl.Popup({ closeOnClick: false })
                .setLngLat([{{ $data->lon }}, {{ $data->lat }}])
                .setHTML('{!! nl2br($data->main)!!}')
                .addTo(map);
-->

@endsection

