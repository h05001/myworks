<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CardDetail;

class CardDetailController extends Controller
{
    //
    public function add()
  {
      return view('admin.carddetail.create');
  }


    public function create(Request $request)
  {
    // Varidationを行う
          $this->validate($request, CardDetail::$rules);

          $carddetail = new CardDetail;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);
          // フォームから送信されてきたimageを削除する
          unset($form['image']);

          // データベースに保存する
          $carddetail->fill($form);
          $carddetail->save();
      return redirect('admin/carddetail/create');
  }

    public function edit()
  {
      return view('admin.carddetail.edit');
  }

    public function update()
  {
      return redirect('admin/carddetail/edit');
  }

  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = CardDetail::where('card_name', $cond_title)->get();
      } else {
          // それ以外はすべてデータを取得する
          $posts = CardDetail::all();
      }
      return view('admin.carddetail.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

}
