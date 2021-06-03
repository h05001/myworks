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
    //カードマスタ
          // Varidationを行う
          $this->validate($request, CardDetail::$rules);

          $carddetail = new CardDetail;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);
          // フォームから送信されてきたimageを削除する
          unset($form['image']);

          // データベースに保存する
          $carddetail->card_master_id = $request->card_master_id;
          $carddetail->card_name = $request->card_name;
          $carddetail->ruby = $request->ruby;
          $carddetail->card_class = $request->card_class;
          $carddetail->image_path = $request->image_path;
          $carddetail->card_text = $request->card_text;
          $carddetail->save();

    //モンスターカードマスタ
          // Varidationを行う
          $this->validate($request, MonsterCardDetail::$rules);

          $monstercarddetail = new MonsterCardDetail;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);


          // データベースに保存する
          $monstercarddetail->card_master_id = $request->card_master_id;
          $monstercarddetail->property = $request->property;
          $monstercarddetail->tribe = $request->tribe;
          $monstercarddetail->level = $request->level;
          $monstercarddetail->rank = $request->rank;
          $monstercarddetail->scale = $request->scale;
          $monstercarddetail->pendulum_effect = $request->pendulum_effect;
          $monstercarddetail->link = $request->link;
          $monstercarddetail->link = $request->link;
          $monstercarddetail->link_marker = $request->link_marker;
          $monstercarddetail->attack = $request->attack;
          $monstercarddetail->defense = $request->defense;
          $monstercarddetail->save();

/*
    //モンスター種類テーブル
          // Varidationを行う
          $this->validate($request, MonsterCardClassesTable::$rules);

          $monstercardclasstable = new MonsterCardClassesTable;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);

          // データベースに保存する
          $monstercardclasstable->card_master_id = $request->card_master_id;
          $monstercardclasstable->class_id = $request->class_id;
          $monstercardclasstable->save();
*/


    //モンスター種類マスタ
          // Varidationを行う
          $this->validate($request, MonsterClassMaster::$rules);

          $monsterclassmaster = new MonsterClassMaster;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);

          // データベースに保存する
          $monsterclassmaster->card_master_id = $request->card_master_id;
          $monsterclassmaster->monster_class = $request->monster_class;
          $monsterclassmaster->save();



    //魔法カードマスタ

          // Varidationを行う
          $this->validate($request, MagicCardDetail::$rules);

          $magiccarddetail = new MagicCardDetail;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);


          // データベースに保存する
          $magiccarddetail->card_master_id = $request->card_master_id;
          $magiccarddetail->magic_card_class = $request->magic_card_class;
          $magiccarddetail->save();


    //罠カードマスタ

          // Varidationを行う
          $this->validate($request, TrapCardDetail::$rules);

          $trapcarddetail = new TrapCardDetail;//$trapcarddetail変数をインスタンス化
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);


          // データベースに保存する
          $trapcarddetail->card_master_id = $request->card_master_id;
          $trapcarddetail->trap_card_class = $request->trap_card_class;
          $trapcarddetail->save();


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
      /*$cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = CardDetail::where('card_name', $cond_title)->get();
      } else {
          // それ以外はすべてデータを取得する
          $posts = CardDetail::all();
      }*/
      return view('admin.carddetail.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

}
