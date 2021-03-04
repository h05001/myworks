<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\MonsterCardDetail;

class MonsterCardDetailController extends Controller
{
    //
    public function add()
  {
      return view('admin.monstercarddetail.create');
  }


    public function create(Request $request)
  {
    // Varidationを行う
          $this->validate($request, MonsterCardDetail::$rules);

          $monstercarddetail = new MonsterCardDetail;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);


          // データベースに保存する
          $monstercarddetail->fill($form);
          $monstercarddetail->save();

      return redirect('admin/monstercarddetail/create');
  }

    public function edit()
  {
      return view('admin.monstercarddetail.edit');
  }

    public function update()
  {
      return redirect('admin/monstercarddetail/edit');
  }

  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = MonsterCardDetail::where('card_master_id', $cond_title)->get();
      } else {
          // それ以外はすべてデータを取得する
          $posts = MonsterCardDetail::all();
      }
      return view('admin.monstercarddetail.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

}
