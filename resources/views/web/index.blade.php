@extends('layouts.app')

@section('content')
<div class="row">

    <div class="col-9">
        <h1>おすすめ商品</h1>
        <div class="row">
            <div class="col-4">
                <a href="#">
                    <img src="{{ asset('img/orange.png') }}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="samazon-product-label mt-2">
                            旬のオレンジ詰め合わせ<br>
                            <label>￥2000</label>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
