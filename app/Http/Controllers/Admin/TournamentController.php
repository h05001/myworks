<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Tournament;

class TournamentController extends Controller
{

  public function add()
  {

      return view('admin.tournament.create');

  }

  public function create(Request $request)
  {
      // Varidationを行う
      $this->validate($request, Tournament::$rules);

      $tournament = new Tournament;
      $form = $request->all();

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);

      // データベースに保存する
      $tournament->fill($form);
      $tournament->save();



      return redirect('admin/tournament/create');
  }
}
