@extends('layouts.app')

@section('content')

<body>
    <header id="header">
      <div class="inner">
        <ul class="navi">
              <li class="textlink02a"><a href="{{route('mypage.form')}}">投稿</a></li>
              <li class="textlink textlink02"><a href="{{route('mypage.history')}}">投稿履歴</a></li>
              <li class="textlink textlink02"><a href="">お気に入り</a></li>
              <li class="textlink textlink02"><a href="{{route('mypage.edit')}}">会員情報</a></li>
        </ul>
      </div>
    </header>
    <div class="wrapper">
    <div class="content_wrapper">
    <div class="content2">
        <main class="content4_flex">
        <div class="content4">
        <!--投稿フォーム-->
        <form action="/newpostsend" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" cols="30" name="title" class="formtitle" placeholder="タイトル" value={{old('title')}}>
            @error('title')
            <p class="perror"><span style="color:red;">{{ $message }}</span></p>
            @enderror
            
            <p>&nbsp;</p>
            <textarea name="main" cols="30" rows="3" type="text" placeholder="フリーコメント" value={{old('main')}}></textarea>
            @error('main')
            <p class="perror"><span style="color:red;">{{ $message }}</span></p>
            @enderror

            <p>&nbsp;</p>
            <textarea name="spot_name" cols="30" rows="1" value="" type="text" placeholder="名称・地名（例：東京博物館）" value={{old('spot_name')}}></textarea>

            <p>
            Preview:<br>
            <canvas id="preview" style="max-width:150px; max-height:200px;"></canvas>
            </p>
            <script>
                function previewImage(obj) //プレビュー
                {
                	var fileReader = new FileReader();
                	fileReader.onload = (function() {
                		var canvas = document.getElementById('preview');
                		var ctx = canvas.getContext('2d');
                		var image = new Image();
                		image.src = fileReader.result;
                		image.onload = (function () {
                			canvas.width = image.width;
                			canvas.height = image.height;
                			ctx.drawImage(image, 0, 0);
                		});
                	});
                	fileReader.readAsDataURL(obj.files[0]);
                }
            </script>
            <p>&nbsp;</p>
            <p>画像をアップロード</p>
            <input type="file" name="post_img" onchange="previewImage(this);"></span>
            <p>&nbsp;</p>
            <input class="btn btn-outline-primary" type="submit" class="submitbtn">
            
            <input type="hidden" id="lat" name="lat" value="">
            <input type="hidden" id="lon" name="lon" value="">
            <input type="hidden" id="address" name="address" value="">
        </form>
        </div>
        
        <div class="content4_grid">
        <div id='map'></div>
        <div id="geocoder" class="geocoder"></div>
        <script>
            $(function(){
        
              mapboxgl.accessToken = 'pk.eyJ1IjoiZ3VzYXJpIiwiYSI6ImNsM3lpMTk3cjNmZnEza2w4OWw5OXBrMzYifQ.DBDiekWcs1_ccUjJg9cGEQ';
              const map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/gusari/cl48qv04o000015o60xusz3pz', // マップのスタイル（デザイン）
                center: [139.69167, 35.68944], // 初期に表示する地図の緯度経度 [経度、緯度]
                zoom: 9 // 初期に表示する地図のズームレベル
              });
              
            // Add the control to the map.
                const geocoder = new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                language: 'ja',
                types: 'poi',
                limit: 10,
                mapboxgl: mapboxgl
                });

                geocoder.on('result', function(e){
                    $('#lat').val(e.result.center[1]);
                    $('#lon').val(e.result.center[0]);
                    $('#address').val(e.result.place_name);
                    console.log(e);
                });
                document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
            });
        </script>
    </div>
    </div>
    </div>
</body>

@endsection