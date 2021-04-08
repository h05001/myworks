{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')
<script type="text/javascript">

function entryChange(){

    if(document.getElementById('changeSelect')){
        id = document.getElementById('changeSelect').value;

        if(id == 'select1'){
            //フォーム
            document.getElementById('firstBox').style.display = "block";
            document.getElementById('secondBox').style.display = "none";
            document.getElementById('thirdBox').style.display = "none";

        }else if(id == 'select2'){
            //フォーム
            document.getElementById('firstBox').style.display = "none";
            document.getElementById('secondBox').style.display = "block";
            document.getElementById('thirdBox').style.display = "none";

        }else if(id == 'select3'){
            //フォーム
            document.getElementById('firstBox').style.display = "none";
            document.getElementById('secondBox').style.display = "none";
            document.getElementById('thirdBox').style.display = "block";

        }
    }
}

//オンロードさせ、リロード時に選択を保持
window.onload = entryChange;

</script>

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
                            <select id="changeSelect"  onchange="entryChange();" class="form-control" name="card_class" value="{{ old('card_class') }}">
                              <option value="select1">モンスターカード</option>
                              <option value="select2">魔法カード</option>
                              <option value="select3">罠カード</option>
                            </select>
                        </div>
                    </div>

                    <!-- 表示非表示切り替え -->
                    <div id="firstBox">

                        <div class="form-group row">
                            <label class="col-md-3" for="class_id">種類ID</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="class_id" value="{{ old('class_id') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="monster_card_class">モンスターカード種類</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="monster_card_class" value="{{ old('monster_card_class') }}">
                            </div>
                        </div>
<!--
                        <select name="monster_card_class" class="form-control"  value="{{ old('monster_card_class') }}">
                            <option value="">モンスターカード種類の選択</option>
                            <option value="normal">通常</option>
                            <option value="effect">効果</option>
                            <option value="ritual">儀式</option>
                            <option value="fusion">融合</option>
                            <option value="synchro">シンクロ</option>
                            <option value="xyz">エクシーズ</option>
                            <option value="toon">トゥーン</option>
                            <option value="spirit">スピリット</option>
                            <option value="union">ユニオン</option>
                            <option value="gemini">デュアル</option>
                            <option value="tuner">チューナー</option>
                            <option value="flip">リバース</option>
                            <option value="pendulum">ペンデュラム</option>
                            <option value="special_summon">特殊召喚</option>
                            <option value="link">リンク</option>

-->
                        <div class="form-group row">
                            <label class="col-md-3" for="property">属性</label>
                            <div class="col-md-9">
                              <!--  <input type="text" class="form-control" name="property" value="{{ old('property') }}"> -->
                                <select name="property" class="form-control"  value="{{ old('property') }}">
                                    <option value="">属性の選択</option>
                                    <option value="dark">闇属性</option>
                                    <option value="light">光属性</option>
                                    <option value="earth">地属性</option>
                                    <option value="water">水属性</option>
                                    <option value="fire">炎属性</option>
                                    <option value="wind">風属性</option>
                                    <option value="divine">神属性</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="tribe">種族</label>
                            <div class="col-md-9">
                            <!--    <input type="text" class="form-control" name="tribe" value="{{ old('tribe') }}"> -->
                                <select name="tribe" class="form-control"  value="{{ old('tribe') }}">
                                    <option value="">種族を選択</option>
                                    <option value="spell_caster">魔法使い族</option>
                                    <option value="dragon">ドラゴン族</option>
                                    <option value="zombie">アンデット族</option>
                                    <option value="warrior">戦士族</option>
                                    <option value="beast_warrior">獣戦士族</option>
                                    <option value="beast">獣族</option>
                                    <option value="winged_beast">鳥獣族</option>
                                    <option value="fiend">悪魔族</option>
                                    <option value="fairy">天使族</option>
                                    <option value="insect">昆虫族</option>
                                    <option value="dinosaur">恐竜族</option>
                                    <option value="reptile">爬虫類族</option>
                                    <option value="fish">魚族</option>
                                    <option value="sea_serpent">海竜族</option>
                                    <option value="aqua">水族</option>
                                    <option value="pyro">炎族</option>
                                    <option value="thunder">雷族</option>
                                    <option value="rock">岩石族</option>
                                    <option value="plant">植物族</option>
                                    <option value="machine">機械族</option>
                                    <option value="psychic">サイキック族</option>
                                    <option value="wyrm">幻竜族</option>
                                    <option value="cyberse">サイバース族</option>
                                    <option value="divine_beast">幻神獣族</option>
                                    <option value="creator">創造神族</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="level">レベル</label>
                            <div class="col-md-9">
                            <!--    <input type="text" class="form-control" name="level" value="{{ old('level') }}"> -->
                                <select name="level" class="form-control"  value="{{ old('level') }}">
                                    <option value="">レベルを選択</option>
                                    <option value="one">1</option>
                                    <option value="two">2</option>
                                    <option value="three">3</option>
                                    <option value="four">4</option>
                                    <option value="five">5</option>
                                    <option value="six">6</option>
                                    <option value="seven">7</option>
                                    <option value="eight">8</option>
                                    <option value="nine">9</option>
                                    <option value="ten">10</option>
                                    <option value="eleven">11</option>
                                    <option value="twelve">12</option>


                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="rank">ランク</label>
                            <div class="col-md-9">
                            <!--    <input type="text" class="form-control" name="rank" value="{{ old('rank') }}"> -->
                                <select name="rank" class="form-control"  value="{{ old('rank') }}">
                                    <option value="">ランクを選択</option>
                                    <option value="one">1</option>
                                    <option value="two">2</option>
                                    <option value="three">3</option>
                                    <option value="four">4</option>
                                    <option value="five">5</option>
                                    <option value="six">6</option>
                                    <option value="seven">7</option>
                                    <option value="eight">8</option>
                                    <option value="nine">9</option>
                                    <option value="ten">10</option>
                                    <option value="eleven">11</option>
                                    <option value="twelve">12</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="scale">スケール</label>
                            <div class="col-md-9">
                          <!--      <input type="text" class="form-control" name="scale" value="{{ old('scale') }}"> -->
                                <select name="scale" class="form-control"  value="{{ old('scale') }}">
                                    <option value="">スケールを選択</option>
                                    <option value="zero">0</option>
                                    <option value="one">1</option>
                                    <option value="two">2</option>
                                    <option value="three">3</option>
                                    <option value="four">4</option>
                                    <option value="five">5</option>
                                    <option value="six">6</option>
                                    <option value="seven">7</option>
                                    <option value="eight">8</option>
                                    <option value="nine">9</option>
                                    <option value="ten">10</option>
                                    <option value="eleven">11</option>
                                    <option value="twelve">12</option>
                                    <option value="thirteen">13</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="pendulum_effect">ペンデュラム効果</label>
                            <div class="col-md-9">
                              <textarea class="form-control" name="pendulum_effect" rows="15">{{ old('pendulum_effect') }}</textarea>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="link">Link</label>
                            <div class="col-md-9">
                              <!--  <input type="text" class="form-control" name="link" value="{{ old('link') }}"> -->
                                <select name="link" class="form-control"  value="{{ old('link') }}">
                                    <option value="">Linkを選択</option>
                                    <option value="one">1</option>
                                    <option value="two">2</option>
                                    <option value="three">3</option>
                                    <option value="four">4</option>
                                    <option value="five">5</option>
                                    <option value="six">6</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="link_marker">マーカーの向き</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="link_marker" value="{{ old('link_marker') }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3" for="attack">攻撃力</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="attack" value="{{ old('attack') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="defense">守備力</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="defense" value="{{ old('defense') }}">
                            </div>
                        </div>
                    </div>

                    <!-- 表示非表示切り替え -->
                    <div id="secondBox">
                        <div class="form-group row">
                            <label class="col-md-3" for="magic_class">魔法カード種類</label>
                            <div class="col-md-9">
                            <!--    <input type="text" class="form-control" name="magic_class" value="{{ old('magic_class') }}"> -->
                                <select name="magic_class" class="form-control"  value="{{ old('magic_class') }}">
                                    <option value="">魔法カード種類を選択</option>
                                    <option value="normal">通常魔法</option>
                                    <option value="equip">装備魔法</option>
                                    <option value="field">フィールド魔法</option>
                                    <option value="quick">速攻魔法</option>
                                    <option value="ritual">儀式魔法</option>
                                    <option value="continuous">永続魔法</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 表示非表示切り替え -->
                    <div id="thirdBox">
                        <div class="form-group row">
                            <label class="col-md-3" for="trap_class">罠カード種類</label>
                            <div class="col-md-9">
                            <!--    <input type="text" class="form-control" name="trap_class" value="{{ old('trap_class') }}"> -->
                                <select name="trap_class" class="form-control"  value="{{ old('trap_class') }}">
                                    <option value="">罠カード種類を選択</option>
                                    <option value="normal">通常罠</option>
                                    <option value="continuous">永続罠</option>
                                    <option value="counter">カウンター罠</option>

                                </select>
                            </div>
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
                  </div>


                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">

                </form>
            </div>
        </div>
    </div>
@endsection



{{--
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

--}}

{{--

<div class="form-group row">
    <label class="col-md-3" for="card_class">カード分類</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="card_class" value="{{ old('card_class') }}">
    </div>
</div>

 --}}
 {{--
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
 --}}
