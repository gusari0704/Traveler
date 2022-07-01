@extends('layouts.app')

@section('content')

@auth

<div class="wrapper02">
<div id="top_block">
    <div class="top_content">
        <div class="top">
            <form class="search_container" action="/" method="GET">
                <input type="text" size="23" name="keyword" value="{{ $keyword }}" placeholder="フリーワードを入力"/>
                <button style="background-color:white; border:none; outline:none;" type="submit" class="fa fa-search"></button>
            </form>
        </div>
    </div>
</div>

<div id='map' style="width:800px; height:450px;">
    <div class='sidebar'>
        <div class='heading'>
            <h1>Our locations</h1>
        </div>
        <pre id='listings' class='listings'>
        </pre>
    </div>
</div>

<!--写真の位置情報-->
<script>

$(function(){
    var features = [
        @foreach($data as $datas)
        {
            'type': 'Feature',
            'properties': {
                'description': '<h5><strong>{{ $datas->title }}</strong></h5>',
                'main': '<p>{{ $datas->main }}</p>'
            },
            'geometry': {
                'type': 'MultiPoint',
                'coordinates': [
                    [{{ $datas->lon }}, {{ $datas->lat }}]
                ]
            }
        },
        @endforeach
    ];
    mapboxgl.accessToken = 'pk.eyJ1IjoiZ3VzYXJpIiwiYSI6ImNsM3lpMTk3cjNmZnEza2w4OWw5OXBrMzYifQ.DBDiekWcs1_ccUjJg9cGEQ';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/gusari/cl48qv04o000015o60xusz3pz', // マップのスタイル（デザイン）
        center: [139.69167, 35.68944], // 初期に表示する地図の緯度経度 [経度、緯度]
        zoom: 4.5 // 初期に表示する地図のズームレベル
    });

    map.on('load', () => {
        map.addSource('places', {
            'type': 'geojson',
            'data': {
                'type': 'FeatureCollection',
                'features': features
            }
        });
        
        // Add a layer showing the places.
        map.addLayer({
            'id': 'places',
            'type': 'circle',
            'source': 'places',
            'paint': {
                'circle-color': '#4264fb',
                'circle-radius': 6,
                'circle-stroke-width': 1,
                'circle-stroke-color': '#ffffff'
            }
        });

        map.addControl(new mapboxgl.NavigationControl());
    });

    map.on('click', 'places', (e) => {

        
        //クリックしたサークルに飛ぶ
        map.flyTo({
            center: e.features[0].geometry.coordinates
        });

        const coordinates = e.features[0].geometry.coordinates.slice();
        const description = e.features[0].properties.description;


        while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
            coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
        }

        document.getElementById('listings').innerHTML = 
            JSON.stringify(e.lngLat.wrap());

        // クリックしたサークル（円）をマップの中央に配置する
        map.on('mouseenter', 'circle', () => {
            map.getCanvas().style.cursor = 'pointer';
        });
        map.on('mouseleave', 'circle', () => {
            map.getCanvas().style.cursor = '';
        });

    });
});
</script>
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
</div>
@else
<main>
    <div class="wrapper02">
    <article>
        <section>
       <!-- カルーセル -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="slider">
              <a href="#carouselExampleIndicators" data-slide-to="0" class="active"></a>
              <a href="#carouselExampleIndicators" data-slide-to="1"></a>
              <a href="#carouselExampleIndicators" data-slide-to="2"></a>
              <a href="#carouselExampleIndicators" data-slide-to="3"></a>
            </div>
            <div class="carousel-inner">
           <div class="carousel-item active">
             <img class="d-block w-100" style="width:100px; height:400px;" src="/storage/image/carousel1.png">
             <div class="carousel-caption d-none d-md-block">
                <h4>Photravelで見つけよう</h4>
                <h1 style="font-weight:900;">最新のスポット</h1>
             </div>
           </div>
           <div class="carousel-item">
             <img class="d-block w-100" src="/storage/image/carousel2.png">
             <div class="carousel-caption d-none d-md-block">
                <h5>Photravelで投稿しよう</h5>
                <h1 style="font-weight:900;">皆で作る観光地</h1>
             </div>
           </div>
           <div class="carousel-item">
             <img class="d-block w-100" src="/storage/image/carousel3.png">
             <div class="carousel-caption d-none d-md-block">
                <h4>Photravelで記録しよう</h4>
                <h1 style="font-weight:900;">あなただけの旅</h1>
             </div>
           </div>
           <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
       </section>
    </article>
    </div>
</main>
@endauth

@endsection

<!--
<img src="/storage/image/top_ground.jpg">
-->