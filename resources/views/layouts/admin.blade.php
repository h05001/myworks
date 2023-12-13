<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        {{-- 後の章で説明します -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <title>@yield('title')</title>

        <!-- Scripts -->
        {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @yield('script')

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込みます --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- この章の後半で作成するCSSを読み込みます --}}
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            {{-- 画面上部に表示するナビゲーションバーです。 --}}
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

                <a class="navbar-brand" >データベースへ登録</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              登録メニュー
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="http://localhost:8000/admin/carddetail">カード情報の新規登録</a>
                                <a class="dropdown-item" href="http://localhost:8000/admin/tribemaster/create">種族マスタの登録</a>
                                <a class="dropdown-item" href="http://localhost:8000/admin/monsterclassmaster/create">モンスターカードの種類登録</a>
                                <a class="dropdown-item" href="http://localhost:8000/admin/recordingpack/create">収録パックの登録</a>
                                <a class="dropdown-item" href="http://localhost:8000/admin/cardshop/create">カードショップの登録</a>
                                <a class="dropdown-item" href="http://localhost:8000/admin/rarity/create">レアリティの登録</a>
                                <a class="dropdown-item" href="http://localhost:8000/admin/rarityconvert/create">レアリティ変換の登録</a>
                                <a class="dropdown-item" href="http://localhost:8000/admin/recordingcard/create">収録カードの登録</a>
                                <a class="dropdown-item" href="http://localhost:8000/admin/carddetail/scrapingConditions">スクレイピングの実行</a>
                                <a class="dropdown-item" href="http://localhost:8000/admin/probability">確率計算</a>
                                <a class="dropdown-item" href="http://localhost:8000/admin/tournament/create">大会情報の登録</a>
                                <a class="dropdown-item" href="http://localhost:8000/admin/tournamentDeck/create">大会デッキ情報の登録</a>
                                <a class="dropdown-item" href="http://localhost:8000/admin/tournamentDeckCard/create">大会デッキカード情報の登録</a>
                            </div>
                        </li>
                    </ul>

                </div>
            </nav>
            {{-- ここまでナビゲーションバー --}}

            <main class="py-4">
                {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
                @yield('content')
            </main>
        </div>
    </body>
</html>
