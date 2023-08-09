<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Tournament;
use App\TournamentDeck;
use App\DeckRegistration;

class TournamentDeckController extends Controller
{
  public function add()
  {
      $tournament_list = \App\Tournament::pluck('tournament_name', 'id');

      $tournament_list_arr =  $tournament_list -> toArray();

      $cnt = array_key_last($tournament_list_arr);

      return view('admin.tournamentDeck.create', [ "tournament_list" => $tournament_list,"cnt" => $cnt ]);

  }

  public function create(Request $request)
  {
      // Varidationを行う
      $this->validate($request, TournamentDeck::$rules);

      $tournamentDeck = new TournamentDeck;
      $form = $request->all();

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);

      // データベースに保存する
      $tournamentDeck->fill($form);
      $tournamentDeck->save();



      return redirect('admin/tournamentDeck/create');
  }



}
