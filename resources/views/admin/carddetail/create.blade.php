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

function entryChangeClass(){
    setLevelSelectBox();//level_rank_linkの値
    document.getElementById('scale').style.display = "none";//スケール
    document.getElementById('pendulum_effect').style.display = "none";//ペンデュラム効果テキスト
    document.getElementById('link_marker').style.display = "none";//マーカーの向き
    document.getElementById('defense').style.display = "none";//守備力
    //document.getElementById('level').style.display = "none";//レベル
    //document.getElementById('rank').style.display = "none";//ランク
    //document.getElementById('link_level').style.display = "none";//リンク

    if(document.getElementById('xyz').checked === true && document.getElementById('pendulum').checked === true){
        //フォーム
        //document.getElementById('rank').style.display = "block";//ランク
        document.getElementById('scale').style.display = "block";//スケール
        document.getElementById('pendulum_effect').style.display = "block";//ペンデュラム効果テキスト
        document.getElementById('defense').style.display = "block";//守備力

    }else if(document.getElementById('xyz').checked === true){
        //フォーム

        //document.getElementById('rank').style.display = "block";//ランク
        document.getElementById('defense').style.display = "block";//守備力

    }else if(document.getElementById('pendulum').checked === true){
        //フォーム
        //document.getElementById('level').style.display = "block";//レベル
        document.getElementById('scale').style.display = "block";//スケール
        document.getElementById('pendulum_effect').style.display = "block";//ペンデュラム効果テキスト
        document.getElementById('defense').style.display = "block";//守備力

    }else if(document.getElementById('link').checked === true){
        //フォーム
        //document.getElementById('link_level').style.display = "block";//リンク
        document.getElementById('link_marker').style.display = "block";//マーカーの向き


    }else{
        //document.getElementById('level').style.display = "block";//レベル
        document.getElementById('defense').style.display = "block";//守備力
    }
  //}
}



function setLevelSelectBox(){
    let lrl = document.getElementById('level_rank_link');


  	while(lrl.lastChild)
  	{
  		lrl.removeChild(lrl.lastChild);
  	}

    var targetArray = new Array();
    //var targetArray = [];

    // チェックボックスの一覧を取得
    var checkBoxs = document.getElementsByClassName('changeCheck');

    // 配列へ変換
    var checkBoxsArr = Array.prototype.slice.call(checkBoxs);

    // チェックボックス文繰り返す
    for ( i = 0; i < checkBoxsArr.length ; i++) {

        if(checkBoxsArr[i].checked){

            if(checkBoxsArr[i].value == "5"){//xyz
                targetArray = new Array("ランクを選択",0,1,2,3,4,5,6,7,8,9,10,11,12,13);
                break;
            }else if(checkBoxsArr[i].value == "14"){//link
                targetArray = new Array("リンクを選択",1,2,3,4,5,6,7,8);
                break;
            }
        }
    }
    if(targetArray.length === 0){//targetArrayの中身が空である場合
        targetArray = new Array("レベルを選択",1,2,3,4,5,6,7,8,9,10,11,12);
    }


    for(let i = 0; i < targetArray.length; i++){
        let option = document.createElement('option');
        if(i != 0){
            option.setAttribute('value', targetArray[i]);
        }
        option.innerHTML = targetArray[i];
        lrl.appendChild(option);
    }
}

function scaleSelectBox(){
    let s = document.getElementById('scale');
    var scaleArray = new Array("スケールを選択",0,1,2,3,4,5,6,7,8,9,10,11,12,13);
/*
    var scaleArray = new Array();

    var checkBoxs = document.getElementsByClassName('changeCheck');

    // 配列へ変換
    var checkBoxsArr = Array.prototype.slice.call(checkBoxs);

    // チェックボックス文繰り返す
    for ( i = 0; i < checkBoxsArr.length ; i++) {

        if(checkBoxsArr[i].checked == '12'){
            scaleArray = new Array("スケールを選択",0,1,2,3,4,5,6,7,8,9,10,11,12,13);
        }else{
        scaleArray = scale.selectedIndex = 0;
        }
    }*/
    for(let i = 0; i < scaleArray.length; i++){
        let option = document.createElement('option');

        if(i != 0){
            option.setAttribute('value', scaleArray[i]);
        }
        option.innerHTML = scaleArray[i];
        scale.appendChild(option);
    }
}

//オンロードさせ、リロード時に選択を保持
window.onload = entryChangeClass;

function changeDisabled(value,checked){
    // チェックボックスの一覧を取得
    var checkBoxs = document.getElementsByClassName('changeCheck');
    // 配列へ変換
    var checkBoxsArr = Array.prototype.slice.call(checkBoxs);
    document.getElementById('normal').disabled = false;  // 有効にする
    document.getElementById('effect').disabled = false;  // 有効にする
    document.getElementById('ritual').disabled = false;  // 有効にする
    document.getElementById('fusion').disabled = false;  // 有効にする
    document.getElementById('synchro').disabled = false;  // 有効にする
    document.getElementById('xyz').disabled = false;  // 有効にする
    document.getElementById('toon').disabled = false;  // 有効にする
    document.getElementById('spirit').disabled = false;  // 有効にする
    document.getElementById('union').disabled = false;  // 有効にする
    document.getElementById('gemini').disabled = false;  // 有効にする
    document.getElementById('tuner').disabled = false;  // 有効にする
    document.getElementById('flip').disabled = false;  // 有効にする
    document.getElementById('pendulum').disabled = false;  // 有効にする
    document.getElementById('special_summon').disabled = false;  // 有効にする
    document.getElementById('link').disabled = false;  // 有効にする
    checked = true;

    // チェックボックス文繰り返す
    for ( i = 0; i < checkBoxsArr.length ; i++) {
      if(checkBoxsArr[i].checked){
        switch (checkBoxsArr[i].value){
          case '0'://normal
            document.getElementById('effect').disabled = checked;  // 無効にする
            document.getElementById('ritual').disabled = checked; // 無効にする
            document.getElementById('fusion').disabled = checked;  // 無効にする
            document.getElementById('synchro').disabled = checked;  // 無効にする
            document.getElementById('xyz').disabled = checked;  // 無効にする
            document.getElementById('toon').disabled = checked;  // 無効にする
            document.getElementById('spirit').disabled = checked;  // 無効にする
            document.getElementById('union').disabled = checked;  // 無効にする
            document.getElementById('gemini').disabled = checked;  // 無効にする
            document.getElementById('flip').disabled = checked;  // 無効にする
            document.getElementById('special_summon').disabled = checked;  // 無効にする
            document.getElementById('link').disabled = checked;  // 無効にする
            break;
          case '1'://effect
            document.getElementById('normal').disabled = checked;  // 無効にする
            break;
          case '2'://ritual
            document.getElementById('normal').disabled = checked;  // 無効にする
            document.getElementById('fusion').disabled = checked;  // 無効にする
            document.getElementById('synchro').disabled = checked;  // 無効にする
            document.getElementById('xyz').disabled = checked;  // 無効にする
            document.getElementById('link').disabled = checked;  // 無効にする
            break;
          case '3'://fusion
            document.getElementById('normal').disabled = checked;  // 無効にする
            document.getElementById('ritual').disabled = checked;  // 無効にする
            document.getElementById('synchro').disabled = checked;  // 無効にする
            document.getElementById('xyz').disabled = checked;  // 無効にする
            document.getElementById('link').disabled = checked;  // 無効にする
            break;
          case '4'://synchro
            document.getElementById('normal').disabled = checked;  // 無効にする
            document.getElementById('ritual').disabled = checked;  // 無効にする
            document.getElementById('fusion').disabled = checked;  // 無効にする
            document.getElementById('xyz').disabled = checked;  // 無効にする
            document.getElementById('link').disabled = checked;  // 無効にする
            break;
          case '5'://xyz
            document.getElementById('normal').disabled = checked;  // 無効にする
            document.getElementById('ritual').disabled = checked;  // 無効にする
            document.getElementById('fusion').disabled = checked;  // 無効にする
            document.getElementById('synchro').disabled = checked;  // 無効にする
            document.getElementById('tuner').disabled = checked;  // 無効にする
            document.getElementById('link').disabled = checked;  // 無効にする
            break;
          case '12'://pendulum
            document.getElementById('link').disabled = checked;  // 無効にする
            break;
          case '14'://link
            document.getElementById('normal').disabled = checked;  // 無効にする
            document.getElementById('ritual').disabled = checked;  // 無効にする
            document.getElementById('fusion').disabled = checked;  // 無効にする
            document.getElementById('synchro').disabled = checked;  // 無効にする
            document.getElementById('xyz').disabled = checked;  // 無効にする
            document.getElementById('tuner').disabled = checked;  // 無効にする
            document.getElementById('flip').disabled = checked;  // 無効にする
            document.getElementById('pendulum').disabled = checked;  // 無効にする
            break;
          case '6'://toon
          case '7'://spirit
          case '8'://union
          case '13'://special_summon
            document.getElementById('normal').disabled = checked;  // 無効にする
            break;
          case '9'://gemini
            document.getElementById('normal').disabled = checked;  // 無効にする
            document.getElementById('ritual').disabled = checked;  // 無効にする
            document.getElementById('fusion').disabled = checked;  // 無効にする
            document.getElementById('synchro').disabled = checked;  // 無効にする
            document.getElementById('xyz').disabled = checked;  // 無効にする
            break;
          case '10'://tuner
            document.getElementById('xyz').disabled = checked;  // 無効にする
            document.getElementById('link').disabled = checked;  // 無効にする
            break;
          case '11'://flip
            document.getElementById('normal').disabled = checked;  // 無効にする
            document.getElementById('link').disabled = checked;  // 無効にする
            break;
          default:
            break;
        }
      }
  }
}
</script>


@section('title', 'カード詳細情報の登録')

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
                              <option value="">カード種類の選択</option>
                              <option value="select1">モンスターカード</option>
                              <option value="select2">魔法カード</option>
                              <option value="select3">罠カード</option>
                            </select>
                        </div>
                    </div>

                    <!-- 表示非表示切り替え -->
                    <div id="firstBox">

                        <div class="form-group row">

                            <div class="col-md-3">
                              <label for="monster_card_class">モンスターカード種類</label>
                            </div>
                            <div class="col-md-9 form-inline">

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox"  onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]" value="0" id="normal">通常</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox"  onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]" value="1" id="effect">効果</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox"  onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]" value="2" id="ritual">儀式</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox"  onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]" value="3" id="fusion">融合</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox"  onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]" value="4" id="synchro">シンクロ</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox"  onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]" value="5" id="xyz">エクシーズ</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox"  onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]" value="6" id="toon">トゥーン</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox"  onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]"  value="7" id="spirit">スピリット</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox"  onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]" value="8" id="union">ユニオン</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox"  onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]"  value="9" id="gemini">デュアル</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox" onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]"  value="10" id="tuner">チューナー</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox" onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]"  value="11" id="flip">リバース</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox" onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]"  value="12" id="pendulum">ペンデュラム</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox" onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]" value="13" id="special_summon">特殊召喚</label>

                                <label class="checkbox-inline" >
                                    <input class="form-check-input changeCheck" type="checkbox" onchange="changeDisabled(this.value,this.checked);entryChangeClass();" name="class_id[]" value="14" id="link">リンク</label>

                                </div>

                          </div>


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
                            <label class="col-md-3" for="tribe_id">種族</label>
                            <div class="col-md-9">
                            <!--    <input type="text" class="form-control" name="tribe" value="{{ old('tribe') }}">
                                -->
                                {{Form::select('tribe_id', $tribelist, null, ['class' => 'form-control'])}}
                                {{--<select name="tribe_id" class="form-control"  value="{{ old('tribe_id') }}">
                                    <option value="">種族を選択</option>
                                    @foreach ($tribelist as $lists) {
                                        echo '<option value="{{ $lists->tribe_id }}">{{ $lists->tribe }}</option>';
                                    }
                                    @endforeach --}}
<!--
                                    <option value="">種族を選択</option>
                                    <option value="1">魔法使い族</option>
                                    <option value="2">ドラゴン族</option>
                                    <option value="3">アンデット族</option>
                                    <option value="4">戦士族</option>
                                    <option value="5">獣戦士族</option>
                                    <option value="6">獣族</option>
                                    <option value="7">鳥獣族</option>
                                    <option value="8">悪魔族</option>
                                    <option value="9">天使族</option>
                                    <option value="10">昆虫族</option>
                                    <option value="11">恐竜族</option>
                                    <option value="12">爬虫類族</option>
                                    <option value="13">魚族</option>
                                    <option value="14">海竜族</option>
                                    <option value="15">水族</option>
                                    <option value="16">炎族</option>
                                    <option value="17">雷族</option>
                                    <option value="18">岩石族</option>
                                    <option value="19">植物族</option>
                                    <option value="20">機械族</option>
                                    <option value="21">サイキック族</option>
                                    <option value="22">幻竜族</option>
                                    <option value="23">サイバース族</option>
                                    <option value="24">幻神獣族</option>
                                    <option value="25">創造神族</option>
-->
                                </select>
                            </div>
                        </div>

                        <div>
                            <div class="form-group row">
                                <label class="col-md-3" for="level_rank_link">レベル/ランク/リンク</label>
                                <div class="col-md-9">

                                    <select name="level_rank_link" id="level_rank_link" class="form-control" value="{{ old('level_rank_link') }}">


                                    </select>
                                </div>
                            </div>
                        </div>



                        <div id="scale">
                            <div class="form-group row">
                                <label class="col-md-3" for="scale">スケール</label>
                                <div class="col-md-9">
                              <!--      <input type="text" class="form-control" name="scale" value="{{ old('scale') }}"> -->
                                    <select name="scale" class="form-control"  value="{{ old('scale') }}">
                                        <option value="">スケールを選択</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div id="pendulum_effect">
                            <div class="form-group row">
                                <label class="col-md-3" for="pendulum_effect">ペンデュラム効果</label>
                                <div class="col-md-9">
                                  <textarea class="form-control" name="pendulum_effect" rows="5">{{ old('pendulum_effect') }}</textarea>

                                </div>
                            </div>
                        </div>



                        <div id="link_marker">
                            <div class="form-group row">
                                <label class="col-md-3" for="link_marker">マーカーの向き</label>
                                  <div class="col-md-1">
                                    <input class="form-check-input" type="checkbox"  name="link_marker[]" class="form-control"  value="1">
                                        <label class="form-check-label" for="1">上</label>
                                  </div>
                                  <div class="col-md-1">
                                    <input class="form-check-input" type="checkbox"  name="link_marker[]" class="form-control"  value="2">
                                        <label class="form-check-label" for="2">右上</label>
                                  </div>
                                  <div class="col-md-1">
                                    <input class="form-check-input" type="checkbox"  name="link_marker[]" class="form-control"  value="3">
                                        <label class="form-check-label" for="3">右</label>
                                  </div>
                                  <div class="col-md-1">
                                    <input class="form-check-input" type="checkbox"  name="link_marker[]" class="form-control"  value="4">
                                        <label class="form-check-label" for="4">右下</label>
                                  </div>

                                  <div class="col-md-1">
                                    <input class="form-check-input" type="checkbox"  name="link_marker[]" class="form-control"  value="5">
                                        <label class="form-check-label" for="5">下</label>
                                  </div>
                                  <div class="col-md-1">
                                    <input class="form-check-input" type="checkbox"  name="link_marker[]" class="form-control"  value="6">
                                        <label class="form-check-label" for="6">左下</label>
                                  </div>
                                  <div class="col-md-1">
                                    <input class="form-check-input" type="checkbox" name="link_marker[]" class="form-control"  value="7">
                                        <label class="form-check-label" for="7">左</label>
                                  </div>
                                  <div class="col-md-1">
                                    <input class="form-check-input" type="checkbox" name="link_marker[]" class="form-control"  value="8">
                                        <label class="form-check-label" for="8">左上</label>
                                  </div>
                              </div>
                          </div>


                        <div class="form-group row">
                            <label class="col-md-3" for="attack">攻撃力</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="attack" value="{{ old('attack') }}">
                            </div>
                        </div>

                        <div id="defense">
                            <div class="form-group row">
                                <label class="col-md-3" for="defense">守備力</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="defense" value="{{ old('defense') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 表示非表示切り替え -->
                    <div id="secondBox">
                        <div class="form-group row">
                            <label class="col-md-3" for="magic_class">魔法カード種類</label>
                            <div class="col-md-9">
                            <!--    <input type="text" class="form-control" name="magic_class" value="{{ old('magic_class') }}"> -->
                                <select name="magic_card_class" class="form-control"  value="{{ old('magic_card_class') }}">
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
                                <select name="trap_card_class" class="form-control"  value="{{ old('trap_card_class') }}">
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
                        <textarea class="form-control" name="card_text" rows="10">{{ old('card_text') }}</textarea>

                      </div>
                  </div>

                  <div class="form-group row">
                       <label class="col-md-2" for="image">カード画像</label>
                      <div class="col-md-10">
                          <input type="file" class="form-control-file" name="image">
                      </div>
                  </div>


                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">

                </form>
            </div>
        </div>
    </div>
@endsection
