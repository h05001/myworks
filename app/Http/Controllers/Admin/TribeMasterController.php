<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Tribe;

class TribeMasterController extends Controller
{

    //
    public function add()
    {
      return view('admin.tribemaster.create');
    }

    public function create(Request $request)
    {
    // Varidationを行う
          $this->validate($request, Tribe::$rules);

          $tribe = new Tribe;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);


          // データベースに保存する
          $tribe->fill($form);
          $tribe->save();

      return redirect('admin/tribemaster/create');
    }

      public function edit()
    {
        return view('admin.tribemaster.edit');
    }

      public function update()
    {
        return redirect('admin/tribemaster/edit');
    }

      public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = TribeMasterClass::where('card_master_id', $cond_title)->get();
        } else {
            // それ以外はすべてデータを取得する
            $posts = TribeMasterClass::all();
        }
        return view('admin.tribemaster.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

}
