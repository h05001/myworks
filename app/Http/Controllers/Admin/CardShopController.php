<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CardShop;

class CardShopController extends Controller
{
    //
    public function add()
  {
      return view('admin.cardshop.create');
  }

    public function create(Request $request)
  {
    // Varidationを行う
          $this->validate($request, CardShop::$rules);

          $cardshop = new CardShop;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);

          // データベースに保存する
          $cardshop->fill($form);
          $cardshop->save();

      return redirect('admin/cardshop/create');
  }

  // 以下を追記
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = CardShop::where('cardshop', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = CardShop::all();
        }
        return view('admin.cardshop.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }


    public function edit(Request $request)
  {
    // CardShop Modelからデータを取得する
      $cardshop = CardShop::find($request->id);
      if (empty($cardshop)) {
        abort(404);
      }
      return view('admin.cardshop.edit',['cardshop_form' => $cardshop]);
  }

    public function update(Request $request)
  {
    // Validationをかける
        $this->validate($request, CardShop::$rules);
        // CardShop Modelからデータを取得する
        $cardshop = CardShop::find($request->id);
        // 送信されてきたフォームデータを格納する
        $cardshop_form = $request->all();
        unset($cardshop_form['_token']);

        // 該当するデータを上書きして保存する
        $cardshop->fill($cardshop_form)->save();
      return redirect('admin/cardshop/');
  }

  public function delete(Request $request)
   {
       // 該当するCardShop Modelを取得
       $cardshop = CardShop::find($request->id);
       // 削除する
       $cardshop->delete();
       return redirect('admin/cardshop/');
   }

}
