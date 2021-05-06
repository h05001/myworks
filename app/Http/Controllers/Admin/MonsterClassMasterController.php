<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\MonsterClassMaster;

class MonsterClassMasterController extends Controller
{
    //
    public function add()
  {
      return view('admin.monsterclassmaster.create');
  }


    public function create(Request $request)
  {
    // Varidationを行う
          $this->validate($request, MonsterClassMaster::$rules);

          $monsterclassmaster = new MonsterClassMaster;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);


          // データベースに保存する
          $monsterclassmaster->fill($form);
          $monsterclassmaster->save();

      return redirect('admin/monsterclassmaster/create');
  }

    public function edit()
  {
      return view('admin.monsterclassmaster.edit');
  }

    public function update()
  {
      return redirect('admin/monsterclassmaster/edit');
  }

  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = MonsterClassMaster::where('card_master_id', $cond_title)->get();
      } else {
          // それ以外はすべてデータを取得する
          $posts = MonsterClassMaster::all();
      }
      return view('admin.monsterclassmaster.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

}
