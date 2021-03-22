<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\MonsterCardClass;

class MonsterCardClassController extends Controller
{
    //
    public function add()
  {
      return view('admin.monstercardclass.create');
  }


    public function create(Request $request)
  {
    // Varidationを行う
          $this->validate($request, MonsterCardClass::$rules);

          $monstercardclass = new MonsterCardClass;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);


          // データベースに保存する
          $monstercardclass->fill($form);
          $monstercardclass->save();

      return redirect('admin/monstercardclass/create');
  }

    public function edit()
  {
      return view('admin.monstercardclass.edit');
  }

    public function update()
  {
      return redirect('admin/monstercardclass/edit');
  }

  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = MonsterCardClass::where('card_master_id', $cond_title)->get();
      } else {
          // それ以外はすべてデータを取得する
          $posts = MonsterCardClass::all();
      }
      return view('admin.monstercardclass.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

}
