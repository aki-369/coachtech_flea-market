<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtech_flea-market</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <!-- ヘッダー -->
    <header>
        <div class="header_container">
            <!-- ロゴ -->
            <a href="/" class="header_logo">
                <img src="{{ asset('logo.svg') }}" alt="Logo">
            </a>

            <!-- ログインページと会員登録ページの場合 -->
            @if(Request::is('login') || Request::is('register'))
                <div></div> <!-- 空のスペースを配置（ロゴだけの場合） -->
            @else
                <!-- 中央の検索バー -->
                <div>
                    <form action="{{ route('search') }}" method="get">
                        <input type="text" name="query" placeholder="検索...">
                    </form>
                </div>

                <!-- ユーザーがログインしている場合 -->
                @auth
                    <div>
                        <a href="{{ route('mypage') }}">マイページ</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">ログアウト</button>
                        </form>
                    </div>
                <!-- ユーザーがログインしていない場合 -->
                @else
                    <div>
                        <a href="{{ route('login') }}">ログイン</a>
                        <a href="{{ route('register') }}">会員登録</a>
                        <a href="{{ route('sell') }}">出品</a>
                    </div>
                @endauth
            @endif
        </div>
    </header>

    <!-- コンテンツ -->
    @yield('content')
</body>
</html>