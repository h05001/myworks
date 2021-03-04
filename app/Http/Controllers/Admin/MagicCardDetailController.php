<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\MagicCardDetail;

class MagicCardDetailController extends Controller
{
    //
    public function add()
  {
      return view('admin.magiccarddetail.create');
  }


    public function create(Request $request)
  {
    // Varidationを行う
          $this->validate($request, MagicCardDetail::$rules);

          $magiccarddetail = new MagicCardDetail;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);


          // データベースに保存する
          $magiccarddetail->fill($form);
          $magiccarddetail->save();
      return redirect('admin/magiccarddetail/create');
  }

    public function edit()
  {
      return view('admin.magiccarddetail.edit');
  }

    public function update()
  {
      return redirect('admin/magiccarddetail/edit');
  }

  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = MagicCardDetail::where('card_master_id', $cond_title)->get();
      } else {
          // それ以外はすべてデータを取得する
          $posts = MagicCardDetail::all();
      }
      return view('admin.magiccarddetail.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

}
