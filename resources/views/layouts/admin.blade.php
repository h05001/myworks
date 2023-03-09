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

            <header class="header">
                  <!-- ヘッダーロゴ -->
                  <div class="logo">データベースへ登録</div>

                  <!-- ハンバーガーメニュー部分 -->
                  <div class="nav">

                    <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
                    <input id="drawer_input" class="drawer_hidden" type="checkbox">

                    <!-- ハンバーガーアイコン -->
                    <label for="drawer_input" class="drawer_open"><span></span></label>

                    <!-- メニュー -->
                    <nav class="nav_content">
                      <ul class="nav_list">
                        <li class="nav_item"><a href="http://localhost:8000/admin/carddetail">カード情報の新規登録</a></li>
                        <li class="nav_item"><a href="http://localhost:8000/admin/tribemaster/create">種族マスタの登録</a></li>
                        <li class="nav_item"><a href="http://localhost:8000/admin/monsterclassmaster/create">モンスターカードの種類登録</a></li>
                        <li class="nav_item"><a href="http://localhost:8000/admin/recordingpack/create">収録パックの登録</a></li>
                        <li class="nav_item"><a href="http://localhost:8000/admin/cardshop/create">カードショップの登録</a></li>
                        <li class="nav_item"><a href="http://localhost:8000/admin/rarity/create">レアリティの登録</a></li>
                        <li class="nav_item"><a href="http://localhost:8000/admin/rarityconvert/create">レアリティ変換の登録</a></li>
                      </ul>
                    </nav>

                  </div>
                </header>
            {{-- ここまでナビゲーションバー --}}

            <main class="py-4">
                {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
                @yield('content')
            </main>
        </div>
    </body>
</html>
