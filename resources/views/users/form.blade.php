@extends('layouts.app')

@section('content')

<body>
    <script>
        function previewImage(obj)
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
    <div class="wrapper">
    <div class="header"><h1>投稿ページ</h1></div>
    <div class="content_wrapper">
    <div class="content2">
    
        <form action="/newpostsend" method="post" enctype="multipart/form-data">
            @csrf
            <p>タイトル</p>
            <input type="text" name="title" class="formtitle" value={{old('title')}}>
            @error('title')
            <p class="perror"><span style="color:red;">{{ $message }}</span></p>
            @enderror
            
            <p>&nbsp;</p>
            <p>本文</p>
            <textarea name="main" cols="40" rows="10" value={{old('main')}} type="text" placeholder="フリーコメント"></textarea>
            @error('main')
            <p class="perror"><span style="color:red;">{{ $message }}</span></p>
            @enderror

            <p>&nbsp;</p>
            <p>名称</p>
            <textarea name="spot_name" cols="20" rows="1" value="" type="text" placeholder="例：東京駅"></textarea>

            <p>
            Preview:<br>
            <canvas id="preview" style="max-width:200px;"></canvas>
            </p>
            <p>&nbsp;</p>
            <p>画像をアップロード</p>
            <input type="file" name="post_img" onchange="previewImage(this);"></span>
            <p>&nbsp;</p>
            <input type="submit" class="submitbtn">
            
            <input type="hidden" id="lat" name="lat" value="">
            <input type="hidden" id="lon" name="lon" value="">
            <input type="hidden" id="address" name="address" value="">
        </form>

        <div id='map' style='width:800px; height:300px; margin:auto;'></div>
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
                collapsed: true,
                language: 'ja',
                types: 'poi',
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