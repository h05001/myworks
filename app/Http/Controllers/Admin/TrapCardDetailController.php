<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\TrapCardDetail;

class TrapCardDetailController extends Controller
{
    //
    public function add()
  {
      return view('admin.trapcarddetail.create');
  }


    public function create(Request $request)
  {
    // Varidationを行う
          $this->validate($request, TrapCardDetail::$rules);

          $trapcarddetail = new TrapCardDetail;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);


          // データベースに保存する
          $trapcarddetail->fill($form);
          $trapcarddetail->save();
      return redirect('admin/trapcarddetail/create');
  }

    public function edit()
  {
      return view('admin.trapcarddetail.edit');
  }

    public function update()
  {
      return redirect('admin/trapcarddetail/edit');
  }

  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = TrapCardDetail::where('card_master_id', $cond_title)->get();
      } else {
          // それ以外はすべてデータを取得する
          $posts = TrapCardDetail::all();
      }
      return view('admin.trapcarddetail.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

}
