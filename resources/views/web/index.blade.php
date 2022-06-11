@extends('layouts.app')

@section('content')

@auth
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

@else
<main>
    <article>
        <section>
       <!-- カルーセル -->
       <div class="carousel slide" id="sample" data-ride="carousel">
           <ol class="carousel-indicators">
                <li data-target="#sample" data-slide-to="0" class="active"></li>
                <li data-target="#sample" data-slide-to="1"></li>
                <li data-target="#sample" data-slide-to="2"></li>
           </ol>
           <div class="carousel-item active">
             <img class="d-block w-100" src="/storage/image/carousel1.png">
             <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
             </div>
           </div>
           <div class="carousel-item">
             <img class="d-block w-100" src="/storage/image/carousel2.png">
             <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
             </div>
           </div>
           <div class="carousel-item">
             <img class="d-block w-100" src="/storage/image/carousel3.png">
             <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
             </div>
           </div>
           <a href="#sample" class="carousel-control-prev" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="sr-only">前の画像へ</span>
            </a>
            <a href="#sample" class="carousel-control-next" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="sr-only">次の画像へ</span>
            </a>
        </div>
       </section>
    </article>
</main>
@endauth

@endsection
