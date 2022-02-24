<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\RarityConvert;

class RarityConvertController extends Controller
{
    //
    public function add()
    {

        return view('admin.rarityconvert.create');
    }

    public function create(Request $request)
    {
    // Varidationを行う
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
