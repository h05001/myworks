{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'カード詳細情報')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>カード詳細情報　新規作成</h2>
                <form action="{{ action('Admin\CardDetailController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>

                    <th>カード種類</th>

                    <td>
                      <select id="changeSelect" name="hoge" onchange="entryChange();">

                        <option value="select1">モンスターカード</option>
                        <option value="select2">魔法カード</option>
                        <option value="select3">罠カード</option>
                      </select>
                    </td>
                    </tr>

                    <!-- 表示非表示切り替え -->
                    <tr id="firstBox">
                    <th>モンスターカード</th>
                    <td><input type="text" />
                    <p>テキスト1</p></td>
                    </tr>

                    <!-- 表示非表示切り替え -->
                    <tr id="secondBox">
                    <th>魔法カード</th>
                    <td><input type="text" />
                    <p>テキスト2</p></td>
                    </tr>

                    <!-- 表示非表示切り替え -->

                    <tr id="thirdBox">
                    <th>罠カード</th>
                    <td><input type="text" />
                    <p>テキスト3</p></td>

                    </tr>

                    </table>
                    </form>

                    <script type="text/javascript">

                    function entryChange(){

                    if(document.getElementById('changeSelect')){
                    id = document.getElementById('changeSelect').value;

                    if(id == 'select1'){
                      //フォーム
                      document.getElementById('firstBox').style.display = "";
                      document.getElementById('secondBox').style.display = "none";
                      document.getElementById('thirdBox').style.display = "none";

                    }else if(id == 'select2'){
                      //フォーム
                      document.getElementById('firstBox').style.display = "none";
                      document.getElementById('secondBox').style.display = "";
                      document.getElementById('thirdBox').style.display = "none";

                    }else if(id == 'select3'){
                      //フォーム
                      document.getElementById('firstBox').style.display = "none";
                      document.getElementById('secondBox').style.display = "none";
                      document.getElementById('thirdBox').style.display = "";

                    }
                    }

                    //オンロードさせ、リロード時に選択を保持
                    window.onload = entryChange;

                    </script>


                    {{--
                    <div class="form-group row">
                        <label class="col-md-3" for="card_name">カード名</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="card_name" value="{{ old('card_name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="ruby">読み方</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="ruby" value="{{ old('ruby') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="card_class">カード分類</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="card_class" value="{{ old('card_class') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3" for="card_text">カードテキスト</label>
                        <div class="col-md-9">
                          <textarea class="form-control" name="card_text" rows="15">{{ old('card_text') }}</textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                         <label class="col-md-2" for="image">カード画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div> --}}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">

                </form>
            </div>
        </div>
    </div>
@endsection
