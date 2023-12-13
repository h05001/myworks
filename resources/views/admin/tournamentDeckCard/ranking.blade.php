
@extends('layouts.admin')
@section('title', '使用カードランキング')

@section('content')
<div class="container">
    <form action="{{ action('Admin\TournamentDeckCardController@ranking') }}" method="get">
        <div class="form-group row">
            <div class="col-md-3" class="form-control">
                <input type = "month" name="term_fr"  value="{{ $term_fr }}">
            </div>
            <div class="col-md-3" class="form-control">
                <input type = "month" name="term_to"  value="{{ $term_to }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3" class="form-control">
                <select name="kinds" id = "kinds" value="kinds"　onchange="selectBox()">

                  <option value="1">メインデッキ</option>
                  <option value="2" @if($kinds == '2')selected @endif >エクストラデッキ</option>
                  <option value="3" @if($kinds == '3')selected @endif >サイドデッキ</option>
                </select>
            </div>

            <div class="col-md-3" class="form-control">
                <select name="card_class" id = "card_class" value="card_class">
                  <option value="">カードの種類</option>
                  <option value="1">モンスター</option>
                  <option value="2" >魔法</option>
                  <option value="3" >罠</option>
                </select>
            </div>

        </div>
        <input type="submit" class="btn btn-primary" value="選択">
    </form>
    <div class="col-md-12 mx-auto">
        <div class="row">
          @if($kinds == 1)
              <div>メインデッキ</div>
          @elseif($kinds == 2)
              <div>エクストラデッキ</div>
          @elseif($kinds == 3)
              <div>サイドデッキ</div>
          @endif

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th width="8%">ランキング</th>
                        <th width="15%">カード名</th>
                        <th width="10%">使用率</th>
                        <th width="15%">投入枚数</th>
                        <th width="7%">カード詳細</th>
                        <th width="7%">カード価格</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $rank = 1;
                        $cnt = 1;
                        $bef_point = 0;
                    @endphp
                    @foreach($monster_ranking as $ranking)

                        {{--前回と同順位の場合は、順位を加算しない--}}
                          @if($bef_point != $ranking -> count)
                               @php $rank = $cnt @endphp
                          @endif
                        {{--ランキング表を20位で終了させる
                        @if(20 <= $rank)
                             @break;
                        @endif
                        --}}
                        <tr>
                            <th>{{ $rank }}</th>
                            <td>{{ str_limit($ranking->card_name, 50) }}</td>

                            <td>{{ str_limit($ranking->rate, 50) }}</td>
                            <td>{{ str_limit($ranking->numbers, 50) }}</td>

                            <td>
                              <div>
                                  <a href="{{ action('Admin\CardDetailController@detail', ['id' => $ranking->id]) }}">詳細</a>
                              </div>

                            </td>
                            <td>
                              <div>
                                  <a href="{{ action('Admin\CardDetailController@price', ['id' => $ranking->id]) }}">価格</a>
                              </div>

                            </td>

                        </tr>
                        @php
                            $bef_point = $ranking -> count;
                            $cnt++;
                        @endphp
                    @endforeach

                </tbody>
            </table>
        </div>


</div>
<script type="text/javascript">
    function selectBox(){
      if(document.getElementById('kinds')){
          id = document.getElementById('kinds').value;
          if(id == 1 ){
              //フォーム
              document.getElementById('card_class').style.display = "block";
          }else {
              document.getElementById('card_class').style.display = "none";
          }
      }


    }
    selectBox();

</script>

@endsection
