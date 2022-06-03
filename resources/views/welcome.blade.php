@extends('layouts.app')

@section('content')
<main>
    <article>
       <!-- カルーセル -->
       <div class="carousel slide" id="sample" data-ride="carousel">
           <ol class="carousel-indicators">
                <li data-target="#sample" data-slide-to="0" class="active"></li>
                <li data-target="#sample" data-slide-to="1"></li>
                <li data-target="#sample" data-slide-to="2"></li>
           </ol>
           <div class="carousel-item active">
             <img class="d-block w-100" src="/storage/image/carousel1.png">
           </div>
           <div class="carousel-item">
             <img class="d-block w-100" src="/storage/image/carousel2.png">
           </div>
           <div class="carousel-item">
             <img class="d-block w-100" src="/storage/image/carousel3.png">
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
@endsection