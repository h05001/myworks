<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tournament;
use App\TournamentDeck;
use App\TournamentDeckCard;
class TournamentDeckCardController extends Controller
{
  public function add()
  {
      $tournament_list = \App\Tournament::pluck('tournament_name', 'id');
      $tournament_list = $tournament_list -> prepend('大会名を選択', '');
      $tournament_deck_list = \App\TournamentDeck::all()-> toArray();
      $tournament__deck_list = json_encode($tournament_deck_list);
      //$tournament_deck_list = \App\TournamentDeck::all();
//dd($tournament_list);
      return view('admin.tournamentDeckCard.import', [ "tournament_list" => $tournament_list ,"tournament_deck_list" => $tournament_deck_list]);

  }

  public function create(Request $request)
  {
      return view('admin.tournamentDeckCard.import');
  }

  public function import(Request $request)
  {
    //dd($request);
    $file = $request->file('import');

    $import = new \SplFileObject($file);
    $import->setFlags(
        \SplFileObject::READ_CSV |      // CSVとして行を読み込み
        \SplFileObject::READ_AHEAD |    // 先読み／巻き戻しで読み込み
        \SplFileObject::SKIP_EMPTY |    // 空行を読み飛ばす
        \SplFileObject::DROP_NEW_LINE   // 行末の改行を読み飛ばす
    );

    $import_flag = false;

    $import->seek(PHP_INT_MAX);//ファイルの最終行に移動

    foreach($import as $row) {
        if (!$import_flag ){
        $import_flag = true;
        continue;
      }

      // 文字コード変換
      $row = mb_convert_encoding($row, "UTF-8",'ASCII,JIS,UTF-8,EUC-JP,SJIS');
      //dd($row[1]);
      if(empty($row[1]) ){
          $card_master_id = null;

      }else {
          $card_master_id = (int)$row[1];
      }
      $import = TournamentDeckCard::create([
        'tournament_deck_id' => $request->tournament_deck_id,
        'kinds' => $row[0],
        'card_master_id' => $card_master_id,

        'card_name' => $row[2],
        'card_class' => $row[3],
        'number' => $row[4],
        //
      ]);
      // $card_master_id = CardDetail::where('card_name', $row[2])->get();
      // $check = TournamentDeckCard::where('card_name', $row[2])->get();
      // if ($card_master_id != null) {
      //   $check -> card_master_id = $card_master_id -> card_master_id;
      // }

    }
      return redirect('admin/tournamentDeckCard/create')->with('flash_message', '登録が完了しました');

  }

  public function ranking(Request $request)
  {

      $kinds = 1;
      if($request-> kinds != null){
          $kinds = $request-> kinds;
      }
      $card_class = $request -> card_class;
      $term_fr = $request -> term_fr;
      $term_to = $request -> term_to;
      $tournament_deck = TournamentDeck::count();

      $ranking = TournamentDeckCard::query();

      $ranking ->selectRaw('COUNT(*) as count , card_name , COUNT(number=1 or null) as cnt1, COUNT(number=2 or null) as cnt2, COUNT(number=3 or null) as cnt3, max(card_master_id) as id')
               ->leftjoin('tournament_decks', 'tournament_deck_cards.tournament_deck_id', '=', 'tournament_decks.id')
               ->leftjoin('tournaments', 'tournament_decks.tournament_id', '=', 'tournaments.id')
               ->where('kinds','=', $kinds);


          if ($request-> card_class != "") {
              $ranking -> where('card_class','=', $card_class);
          }
          if ($term_fr != '') {//以降
              // 検索されたら検索結果を取得する
              $ranking -> where('date', '>=' ,$term_fr);
          }

          if ($term_to != '') {//以前
              // 検索されたら検索結果を取得する
              $ranking -> where('date', '<=' ,$term_to);
          }
      $ranking ->orderBy('count', 'desc')
               ->groupBy('card_name');

      $monster_ranking = $ranking -> get();

      //dd($monster_ranking);

      foreach ($monster_ranking as $value) {
          $value -> rate = round($value -> count / $tournament_deck * 100 , 1);
          $value -> numbers = "1枚:".round($value -> cnt1 / $value -> count * 100 , 1)."%, 2枚:".round($value -> cnt2 / $value -> count * 100 , 1)."%, 3枚:".round($value -> cnt3 / $value -> count * 100 , 1)."%";
      }

      //dd($monster_ranking);
      return view('admin.tournamentDeckCard.ranking', [ "monster_ranking" => $monster_ranking, "kinds" => $kinds, "term_fr" => $term_fr, "term_to" => $term_to]);
  }

}
// $monster_ranking = TournamentDeckCard::selectRaw('COUNT(card_name) as count , card_name')
//                                      ->where('kinds','=', '1')
//                                      ->where('card_class','=', '1')
//                                      ->orderBy('count', 'desc')
//                                      ->groupBy('card_name')
//                                      ->get();
