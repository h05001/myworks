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
                       <label class="col-md-3">検索：カード名</label>
                       <div class="col-md-9">
                          <input type="text" class="form-control" name="cond_card_name" value="{{ $cond_card_name }}">
                       </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3">検索：カード分類</label>
                      <div class="col-md-9">
                          <select class="form-control" name="cond_card_class" >
                              <option value="">カード種類で検索</option>
                              <option value="select1" <?php echo array_key_exists('cond_card_class', $_POST) && $_POST['cond_card_class'] == 'select1' ? 'selected' : ''; ?> >モンスターカード</option>
                              <option value="select2" <?php echo array_key_exists('cond_card_class', $_POST) && $_POST['cond_card_class'] == 'select2' ? 'selected' : ''; ?> >魔法カード</option>
                              <option value="select3" <?php echo array_key_exists('cond_card_class', $_POST) && $_POST['cond_card_class'] == 'select3' ? 'selected' : ''; ?> >罠カード</option>

                          </select>
                      </div>
                  </div>
                          <!--  <input type="text" class="form-control" name="cond_card_class" value="{{ $cond_card_class }}">
-->
                  <div class="form-group row">
                      <label class="col-md-3">検索：魔法カード種類</label>
                      <div class="col-md-9">
                      <!--    <input type="text" class="form-control" name="magic_class" value="{{ old('magic_class') }}"> -->
                          <select class="form-control" name="cond_magic_card_class">
                              <option value="">魔法カード種類で検索</option>
                              <option value="normal">通常魔法</option>
                              <option value="equip">装備魔法</option>
                              <option value="field">フィールド魔法</option>
                              <option value="quick">速攻魔法</option>
                              <option value="ritual">儀式魔法</option>
                              <option value="continuous">永続魔法</option>

                          </select>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-md-3">検索：罠カード種類</label>
                      <div class="col-md-9">
                      <!--    <input type="text" class="form-control" name="trap_class" value="{{ old('trap_class') }}"> -->
                          <select class="form-control" name="cond_trap_card_class">
                              <option value="">罠カード種類で検索</option>
                              <option value="normal">通常罠</option>
                              <option value="continuous">永続罠</option>
                              <option value="counter">カウンター罠</option>

                          </select>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-md-3">検索：属性</label>
                      <div class="col-md-9">
                        <!--  <input type="text" class="form-control" name="property" value="{{ old('property') }}"> -->
                          <select class="form-control" name="cond_property">
                              <option value="">属性で検索</option>
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
                      <label class="col-md-3">検索：種族</label>
                      <div class="col-md-9">
                      <!--    <input type="text" class="form-control" name="tribe" value="{{ old('tribe') }}"> -->
                          <select class="form-control" name="cond_tribe">
                              <option value="">種族で検索</option>
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
                      <label class="col-md-3">検索：スケール</label>
                      <div class="col-md-9">
                    <!--      <input type="text" class="form-control" name="scale" value="{{ old('scale') }}"> -->
                          <select class="form-control" name="cond_scale">
                              <option value="">スケールで検索</option>
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
                      <div class="col-md-2">
                          {{ csrf_field() }}
                          <input type="submit" class="btn btn-primary" value="検索">
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
                                    <th>{{ $carddetail->card_master_id }}</th>
                                    <td>{{ str_limit($carddetail->card_name, 50) }}</td>
                                    <td>{{ str_limit($carddetail->ruby, 50) }}</td>
                                    <td>{{ str_limit($carddetail->card_class, 50) }}</td>
                          <!--      <td>{{ str_limit($carddetail->image_path, 50) }}</td> -->
                                    <td>{{ str_limit($carddetail->card_text, 300) }}</td>


                                    <td>
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
