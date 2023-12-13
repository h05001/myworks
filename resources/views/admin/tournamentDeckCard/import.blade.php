@extends('layouts.admin')
@section('title', '入賞デッキの登録')


@section('content')

    <div class="container">
        <div class="row">
            <h2>入賞デッキカードの登録</h2>
        </div>


            <form action="{{ action('Admin\TournamentDeckCardController@import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <label class="col-md-2">大会ID</label>
                    <div class="col-md-8">

                        {{Form::select('id', $tournament_list, null, ['class' => 'form-control','id' => 'tournament' , 'onchange'=>'selectBox()']) }}

                    </div>
                </div>
                <div class="row">
                    <label class="col-md-2" >デッキ名</label>
                    <div class="col-md-8">

                      <select name="tournament_deck_id" class="form-control"  id = "tournament_deck" value="{{ old('tournament_deck_id') }}" >

                      </select>

                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8">

                    <div class="grid grid-cols-1">
                        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">CSVファイルを選択（必須）</label>
                        <input type='file' name='import' />

                    </div>
                </div>
                <button type="submit" class='bg-gray-500 hover:bg-gray-700 text-black font-bold py-1 px-3 mt-1 rounded'>登録</button>
            </form>

    </div>

    <script type="text/javascript">
        function selectBox(){

          const tournament_deck_list = @json($tournament_deck_list);
          // var tournament_deck_list=[
          //     { id: 1, tournament_id: 1 , deck_name: 'VS' },
          //     { id: 2, tournament_id: 2 , deck_name: 'R-ACE' },
          //
          // ];
          const tournament = document.getElementById('tournament');
          //console.log(tournament);
          const tournament_deck = document.getElementById('tournament_deck');


          // 小分類のプルダウンをリセット
          const options = document.querySelectorAll('#tournament_deck > option');
          options.forEach(option => {
            option.remove();
          });

          // 小分類のプルダウンに「選択してください」を加える
          const firstSelect = document.createElement('option');
          firstSelect.textContent = 'デッキ名を選択してください';
          tournament_deck.appendChild(firstSelect);

          // 大分類で選択されたカテゴリーと同じ小分類のみを、プルダウンの選択肢に設定する
          tournament_deck_list.forEach(tournament_deck_list => {
            if (tournament.value == tournament_deck_list.tournament_id) {
              const option = document.createElement('option');
              option.textContent = tournament_deck_list.deck_name;
              option.value = tournament_deck_list.id;
              tournament_deck.appendChild(option);
            }
          });

        }

    </script>
@endsection
