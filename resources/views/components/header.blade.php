<nav style="position:fixed; z-index: 999; width:100%; left:0; right:0;" class="navbar navbar-expand-md navbar-light shadow-sm samazon-header-container">
    <a class="navbar-brand ml-2" href="{{ url('/') }}">
        {{ config('app.name', 'Photravel') }}
    </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto mr-5 mt-2">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}"><label>新規登録</label></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}"><label>ログイン</label></a>
            </li>
            <hr>
            <!--
            <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('login') }}"><i class="far fa-heart"></i></a>
            </li>
            <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-shopping-cart"></i></a>
            </li> -->
            @else
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('mypage') }}">
                     <i class="fas fa-user mr-1"></i><label>マイページ</label>
                 </a>
             </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ログアウト
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endguest
        </ul>
    </div>
</nav>