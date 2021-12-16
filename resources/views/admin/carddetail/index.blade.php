<script>
function clearFormAll() {
    for (var i=0; i<document.forms.length; ++i) {
        clearForm(document.forms[i]);
    }
}
function clearForm(form) {
    for(var i=0; i<form.elements.length; ++i) {
        clearElement(form.elements[i]);
    }
}
function clearElement(element) {
    switch(element.type) {
        case "hidden":
        case "submit":
        case "reset":
        case "button":
        case "image":
            return;
        case "file":
            return;
        case "text":
        case "password":
        case "textarea":
            element.value = "";
            return;
        case "checkbox":
            element.checked = false;
            return;
        case "radio":
            element.checked = false;
            return;
        case "select-one":
        case "select-multiple":
            element.selectedIndex = 0;
            return;
        default:
    }
}

</script>
@extends('layouts.admin')
@section('title', '登録済みカードの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>登録カード一覧</h2>
        </div>
        <div class="row">

            <div class="col-md-12">
                <form action="{{ action('Admin\CardDetailController@index') }}" method="get">
                   <div class="form-group row">
                       <label class="col-md-2">検索：カード名</label>
                       <div class="col-md-9">
                          <input type="text" class="form-control" name="cond_card_name" value="{{ $cond_card_name }}">
                       </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-2">検索：カード分類</label>
                      <div class="col-md-3">
                          <select class="form-control" name="cond_card_class" >
                              <option value="">カード種類で検索</option>
                              <option value="select1"  @if($cond_card_class == 'select1')selected @endif >モンスターカード</option>
                              <option value="select2"  @if($cond_card_class == 'select2')selected @endif >魔法カード</option>
                              <option value="select3"  @if($cond_card_class == 'select3')selected @endif >罠カード</option>

                          </select>
                      </div>
                  </div>
                          <!--  <input type="text" class="form-control" name="cond_card_class" value="{{ $cond_card_class }}">
-->
                  <div class="form-group row">
                      <label class="col-md-2">検索：魔法カード種類</label>
                      <div class="col-md-3">
                      <!--    <input type="text" class="form-control" name="magic_class" value="{{ old('magic_class') }}"> -->
                          <select class="form-control" name="cond_magic_card_class">
                              <option value="">魔法カード種類で検索</option>
                              <option value="normal" @if($cond_magic_card_class == 'normal')selected @endif >通常魔法</option>
                              <option value="equip" @if($cond_magic_card_class == 'equip')selected @endif >装備魔法</option>
                              <option value="field" @if($cond_magic_card_class == 'field')selected @endif >フィールド魔法</option>
                              <option value="quick" @if($cond_magic_card_class == 'quick')selected @endif >速攻魔法</option>
                              <option value="ritual" @if($cond_magic_card_class == 'ritual')selected @endif >儀式魔法</option>
                              <option value="continuous" @if($cond_magic_card_class == 'continuous')selected @endif >永続魔法</option>

                          </select>
                      </div>
                  <!--</div>

                  <div class="form-group row">-->
                      <label class="col-md-2">検索：罠カード種類</label>
                      <div class="col-md-3">
                      <!--    <input type="text" class="form-control" name="trap_class" value="{{ old('trap_class') }}"> -->
                          <select class="form-control" name="cond_trap_card_class">
                              <option value="">罠カード種類で検索</option>
                              <option value="normal" @if($cond_trap_card_class == 'normal')selected @endif >通常罠</option>
                              <option value="continuous" @if($cond_trap_card_class == 'continuous')selected @endif >永続罠</option>
                              <option value="counter" @if($cond_trap_card_class == 'counter')selected @endif >カウンター罠</option>

                          </select>
                      </div>
                  </div>

                  <div class="form-group row">

                      <div class="col-md-3">
                          <label for="monster_card_class">検索：モンスターカード種類</label>
                      </div>
                      <div class="col-md-9 form-inline">

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]" value="0" @if(in_array('0', $cond_class_id, true)) checked @endif>通常</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]" value="1" @if(in_array('1', $cond_class_id, true)) checked @endif>効果</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]" value="2" @if(in_array('2', $cond_class_id, true)) checked @endif>儀式</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]" value="3" @if(in_array('3', $cond_class_id, true)) checked @endif>融合</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]" value="4" @if(in_array('4', $cond_class_id, true)) checked @endif>シンクロ</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]" value="5" @if(in_array('5', $cond_class_id, true)) checked @endif>エクシーズ</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]" value="6" @if(in_array('6', $cond_class_id, true)) checked @endif>トゥーン</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]" value="7" @if(in_array('7', $cond_class_id, true)) checked @endif>スピリット</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]" value="8" @if(in_array('8', $cond_class_id, true)) checked @endif>ユニオン</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]"  value="9" @if(in_array('9', $cond_class_id, true)) checked @endif>デュアル</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]"  value="10" @if(in_array('10', $cond_class_id, true)) checked @endif>チューナー</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]"  value="11" @if(in_array('11', $cond_class_id, true)) checked @endif>リバース</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]"  value="12" @if(in_array('12', $cond_class_id, true)) checked @endif>ペンデュラム</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]" value="13" @if(in_array('13', $cond_class_id, true)) checked @endif>特殊召喚</label>

                          <label class="checkbox-inline" >
                              <input class="form-check-input changeCheck" type="checkbox"  name="cond_class_id[]" value="14" @if(in_array('14', $cond_class_id, true)) checked @endif>リンク</label>

                          </div>

                    </div>

                  <div class="form-group row">
                      <label class="col-md-2">検索：属性</label>
                      <div class="col-md-3">
                        <!--  <input type="text" class="form-control" name="property" value="{{ old('property') }}"> -->
                          <select class="form-control" name="cond_property">
                              <option value="">属性で検索</option>
                              <option value="dark" @if($cond_property == 'dark')selected @endif >闇属性</option>
                              <option value="light" @if($cond_property == 'light')selected @endif >光属性</option>
                              <option value="earth" @if($cond_property == 'earth')selected @endif >地属性</option>
                              <option value="water" @if($cond_property == 'water')selected @endif >水属性</option>
                              <option value="fire" @if($cond_property == 'fire')selected @endif >炎属性</option>
                              <option value="wind" @if($cond_property == 'wind')selected @endif >風属性</option>
                              <option value="divine" @if($cond_property == 'divine')selected @endif >神属性</option>

                          </select>
                      </div>
                  <!--</div>

                  <div class="form-group row">-->
                      <label class="col-md-2">検索：種族</label>
                      <div class="col-md-3">
                      <!--    <input type="text" class="form-control" name="tribe" value="{{ old('tribe') }}"> -->
                          <select class="form-control" name="cond_tribe_id">
                              <option value="">種族で検索</option>
                              <option value="spell_caster" @if($cond_tribe_id == 'spell_caster')selected @endif >魔法使い族</option>
                              <option value="dragon" @if($cond_tribe_id == 'dragon')selected @endif >ドラゴン族</option>
                              <option value="zombie" @if($cond_tribe_id == 'zombie')selected @endif >アンデット族</option>
                              <option value="warrior" @if($cond_tribe_id == 'warrior')selected @endif >戦士族</option>
                              <option value="beast_warrior" @if($cond_tribe_id == 'beast_warrior')selected @endif >獣戦士族</option>
                              <option value="beast" @if($cond_tribe_id == 'beast')selected @endif >獣族</option>
                              <option value="winged_beast" @if($cond_tribe_id == 'winged_beast')selected @endif >鳥獣族</option>
                              <option value="fiend" @if($cond_tribe_id == 'fiend')selected @endif >悪魔族</option>
                              <option value="fairy" @if($cond_tribe_id == 'fairy')selected @endif >天使族</option>
                              <option value="insect" @if($cond_tribe_id == 'insect')selected @endif >昆虫族</option>
                              <option value="dinosaur" @if($cond_tribe_id == 'dinosaur')selected @endif >恐竜族</option>
                              <option value="reptile" @if($cond_tribe_id == 'reptile')selected @endif >爬虫類族</option>
                              <option value="fish" @if($cond_tribe_id == 'fish')selected @endif >魚族</option>
                              <option value="sea_serpent" @if($cond_tribe_id == 'sea_serpent')selected @endif >海竜族</option>
                              <option value="aqua" @if($cond_tribe_id == 'aqua')selected @endif >水族</option>
                              <option value="pyro" @if($cond_tribe_id == 'pyro')selected @endif >炎族</option>
                              <option value="thunder" @if($cond_tribe_id == 'thunder')selected @endif >雷族</option>
                              <option value="rock" @if($cond_tribe_id == 'rock')selected @endif >岩石族</option>
                              <option value="plant" @if($cond_tribe_id == 'plant')selected @endif >植物族</option>
                              <option value="machine" @if($cond_tribe_id == 'machine')selected @endif >機械族</option>
                              <option value="psychic" @if($cond_tribe_id == 'psychic')selected @endif >サイキック族</option>
                              <option value="wyrm" @if($cond_tribe_id == 'wyrm')selected @endif >幻竜族</option>
                              <option value="cyberse" @if($cond_tribe_id == 'cyberse')selected @endif >サイバース族</option>
                              <option value="divine_beast" @if($cond_tribe_id == 'divine_beast')selected @endif >幻神獣族</option>
                              <option value="creator" @if($cond_tribe_id == 'creator')selected @endif >創造神族</option>

                          </select>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-md-2">検索：レベル/ランク/リンク</label>
                      <div class="col-md-3">

                          <select class="form-control" name="cond_level_rank_link_fr">
                              <option value="">レベル/ランク/リンクで検索(以上)</option>
                              @for($i = 0 ; $i <= 13 ; $i++)
                                  <option value={{$i}} @if($cond_level_rank_link_fr ===(string)$i)selected @endif >{{$i}}</option>
                              @endfor


                          </select>
                      </div>
                  <!--</div>

                  <div class="form-group row">
                      <label class="col-md-3">検索：レベル/ランク/リンク(以下)</label>-->
                      <div class="col-md-3">

                          <select class="form-control" name="cond_level_rank_link_to">
                              <option value="">レベル/ランク/リンクで検索(以下)</option>
                              @for($i = 0 ; $i <= 13 ; $i++)
                                  <option value={{$i}} @if($cond_level_rank_link_to ===(string)$i)selected @endif >{{$i}}</option>
                              @endfor

                          </select>
                      </div>
                  </div>


                  <div class="form-group row">
                      <label class="col-md-2">検索：スケール</label>
                      <div class="col-md-3">
                    <!--      <input type="text" class="form-control" name="scale" value="{{ old('scale') }}"> -->
                          <select class="form-control" name="cond_scale_fr">
                              <option value="">スケールで検索(以上)</option>
                              @for($i = 0 ; $i <= 13 ; $i++)
                                  <option value={{$i}} @if($cond_scale_fr ===(string)$i)selected @endif >{{$i}}</option>
                              @endfor

                          </select>
                      </div>
                  <!--</div>

                  <div class="form-group row">
                      <label class="col-md-3">検索：スケール(以下)</label>-->
                      <div class="col-md-3">
                    <!--      <input type="text" class="form-control" name="scale" value="{{ old('scale') }}"> -->
                          <select class="form-control" name="cond_scale_to">
                              <option value="">スケールで検索(以下)</option>
                              @for($i = 0 ; $i <= 13 ; $i++)
                                  <option value={{$i}} @if($cond_scale_to ===(string)$i)selected @endif >{{$i}}</option>
                              @endfor
                          </select>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-md-2">検索：攻撃力(以上)</label>
                      <div class="col-md-3">
                         <input type="text" class="form-control" name="cond_attack_fr" value="{{ $cond_attack_fr }}">
                      </div>
                      <label class="col-md-2">検索：攻撃力(以下)</label>
                      <div class="col-md-3">
                         <input type="text" class="form-control" name="cond_attack_to" value="{{ $cond_attack_to }}">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-md-2">検索：守備力(以上)</label>
                      <div class="col-md-3">
                         <input type="text" class="form-control" name="cond_defense_fr" value="{{ $cond_defense_fr }}">
                      </div>
                      <label class="col-md-2">検索：守備力(以下)</label>
                      <div class="col-md-3">
                         <input type="text" class="form-control" name="cond_defense_to" value="{{ $cond_defense_to }}">
                      </div>
                  </div>

                  <div id="link_marker">
                      <div class="form-group row">
                          <label class="col-md-3" for="link_marker">検索:マーカーの向き</label>
                            <div class="col-md-1">
                              <input class="form-check-input" type="checkbox"  name="cond_link_marker[]" class="form-control"  value="1" @if(in_array('1', $cond_link_marker, true)) checked @endif>
                                  <label class="form-check-label" for="1">上</label>
                            </div>
                            <div class="col-md-1">
                              <input class="form-check-input" type="checkbox"  name="cond_link_marker[]" class="form-control"  value="2" @if(in_array('2', $cond_link_marker, true)) checked @endif>
                                  <label class="form-check-label" for="2">右上</label>
                            </div>
                            <div class="col-md-1">
                              <input class="form-check-input" type="checkbox"  name="cond_link_marker[]" class="form-control"  value="3" @if(in_array('3', $cond_link_marker, true)) checked @endif>
                                  <label class="form-check-label" for="3">右</label>
                            </div>
                            <div class="col-md-1">
                              <input class="form-check-input" type="checkbox"  name="cond_link_marker[]" class="form-control"  value="4" @if(in_array('4', $cond_link_marker, true)) checked @endif>
                                  <label class="form-check-label" for="4">右下</label>
                            </div>

                            <div class="col-md-1">
                              <input class="form-check-input" type="checkbox"  name="cond_link_marker[]" class="form-control"  value="5" @if(in_array('5', $cond_link_marker, true)) checked @endif>
                                  <label class="form-check-label" for="5">下</label>
                            </div>
                            <div class="col-md-1">
                              <input class="form-check-input" type="checkbox"  name="cond_link_marker[]" class="form-control"  value="6" @if(in_array('6', $cond_link_marker, true)) checked @endif>
                                  <label class="form-check-label" for="6">左下</label>
                            </div>
                            <div class="col-md-1">
                              <input class="form-check-input" type="checkbox" name="cond_link_marker[]" class="form-control"  value="7" @if(in_array('7', $cond_link_marker, true)) checked @endif>
                                  <label class="form-check-label" for="7">左</label>
                            </div>
                            <div class="col-md-1">
                              <input class="form-check-input" type="checkbox" name="cond_link_marker[]" class="form-control"  value="8" @if(in_array('8', $cond_link_marker, true)) checked @endif>
                                  <label class="form-check-label" for="8">左上</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2">検索：キーワード</label>
                        <div class="col-md-9">
                           <input type="text" class="form-control" name="cond_key_word" value="{{ $cond_key_word }}">
                        </div>
                    </div>


                  <div class="form-group row">
                      <div class="col-md-2">
                          {{ csrf_field() }}
                          <input type="submit" class="btn btn-primary" value="検索">
                      </div>
                      <div>
                          <input type="button" class="btn btn-primary" value="リセット" onClick="clearFormAll(); "/>
                      </div>
                  </div>
                </form>
            </div>
        <div class="col-md-4">
            <a href="{{ action('Admin\CardDetailController@add') }}" role="button" class="btn btn-primary">新規作成</a>
        </div>

        <div class="row">
              <div class="list-news col-md-12 mx-auto">
                  <div class="row">

                   <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="25%">カード名</th>
                                <th width="25%">読み</th>
                                <th width="10%">カードの種類</th>
                          <!--  <th width="10%">カード画像</th> -->
                                <th width="35%">カードテキスト</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $carddetail)
                                <tr>
                                    <th>{{ $carddetail->id }}</th>
                                    <td>{{ str_limit($carddetail->card_name, 50) }}</td>
                                    <td>{{ str_limit($carddetail->ruby, 50) }}</td>
                                    <td>{{ str_limit($carddetail->card_class, 50) }}</td>
                          <!--      <td>{{ str_limit($carddetail->image_path, 50) }}</td> -->
                                    <td>{{ str_limit($carddetail->card_text, 300) }}</td>


                                    <td>
                                      <div>
                                          <a href="{{ action('Admin\CardDetailController@detail', ['id' => $carddetail->id]) }}">詳細</a>
                                      </div>
                                      <div>
                                          <a href="{{ action('Admin\CardDetailController@edit', ['id' => $carddetail->id]) }}">編集</a>
                                      </div>
                                      <div>
                                          <a href="{{ action('Admin\CardDetailController@delete', ['id' => $carddetail->id]) }}">削除</a>
                                      </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
