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
      $row = mb_convert_encoding($row, "UTF-8","sjis-win, sjis");

      $import = TournamentDeckCard::create([
        'tournament_deck_id' => $request->tournament_deck_id,
        'kinds' => $row[0],
        //'card_master_id' => $row[1],
        'card_name' => $row[2],
        'card_class' => $row[3],
        'number' => $row[4],
      ]);

      return redirect('admin/tournamentDeckCard/import')->with('flash_message', '登録が完了しました');

    }
  }
}
