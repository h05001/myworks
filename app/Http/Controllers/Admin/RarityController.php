<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Rarity;

class RarityController extends Controller
{

    //
    public function add()
    {
        $raritylist = \App\Rarity::pluck('rarity_jp', 'id');
        //dd($raritylist);
        $raritylist = $raritylist -> prepend('レアリティを選択', '');


        return view('admin.rarity.create',[ "raritylist" => $raritylist ]);
    }

    public function create(Request $request)
    {
    // Varidationを行う
          $this->validate($request, Rarity::$rules);

          $rarity = new Rarity;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);


          // データベースに保存する
          $rarity->fill($form);
          $rarity->save();

      return redirect('admin/rarity/create');
    }


}
