@extends('layouts.app')

@section('content')
<header id="header">
  <div class="inner">
    <ul class="navi">
          <li class="textlink textlink02"><a href="{{route('mypage.form')}}">投稿</a></li>
          <li class="textlink textlink02"><a href="{{route('mypage.history')}}">投稿履歴</a></li>
          <li class="textlink textlink02"><a href="">お気に入り</a></li>
          <li class="textlink textlink02"><a href="{{route('mypage.edit')}}">会員情報</a></li>
    </ul>
  </div>
</header>
<!--
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="fas fa-map-marked fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ml-3 mt-3">
                        <div class="d-flex flex-column">
                            <label for="user-name">お届け先の変更</label>
                            <p>登録住所の変更</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{route('mypage.edit_address')}}">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr>
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="fas fa-sign-out-alt fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ml-2 mt-3">
                        <div class="d-flex flex-column">
                            <label for="user-name">ログアウト</label>
                            <p>ログアウトします</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
-->

@endsection