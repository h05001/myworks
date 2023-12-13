<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\RarityConvert;
use App\Rarity;
use App\CardShop;

class RarityConvertController extends Controller
{
    //
    public function add()
    {
        $raritylist = \App\Rarity::pluck('rarity_jp', 'id');
        //dd($raritylist);
        $raritylist = $raritylist -> prepend('レアリティIDを選択', '');

        $shoplist = \App\CardShop::pluck('cardshop', 'id');
        //dd($raritylist);
        $shoplist = $shoplist -> prepend('カードショップIDを選択', '');

        return view('admin.rarityconvert.create',[ "raritylist" => $raritylist, "shoplist" => $shoplist ]);
    }

    public function create(Request $request)
    {
    // Varidationを行う
    //dd($request);
          $this->validate($request, RarityConvert::$rules);

          $rarityconvert = new RarityConvert;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);


          // データベースに保存する
          $rarityconvert->fill($form);
          $rarityconvert->save();

      return redirect('admin/rarityconvert/create');
    }

    //RarityConvert Modelに関連付けを行う
    public function rarities()
    {
        return $this->hasone('App\Rarity', 'id');
    }

    public function cardshops()
    {
        return $this->hasone('App\CardShop', 'id');
    }

}
