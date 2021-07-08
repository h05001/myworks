<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CardDetail;
use App\MonsterCardDetail;
use App\MonsterCardClass;
use App\MagicCardDetail;
use App\TrapCardDetail;

class CardDetailController extends Controller
{
    public function add()
    {
        return view('admin.carddetail.create');
    }


    public function create(Request $request)
    {
//dd($request);
        $request->input("card_class");

        //カードマスタ
        // Varidationを行う
        $this->validate($request, CardDetail::$rules);

        $carddetail = new CardDetail;

        // データベースに保存する
        $carddetail->card_name = $request->card_name;
        $carddetail->ruby = $request->ruby;
        $carddetail->card_class = $request->card_class;
        $carddetail->image_path = $request->image_path;
        $carddetail->card_text = $request->card_text;
        $carddetail->save();
        $last_insert_id = $carddetail->id;

        //モンスターカードマスタ
        if($request->card_class == "select1"){

            $rules = MonsterCardDetail::getRules($request->class_id);
            $monstercardclass = new MonsterCardClass;

            // Varidationを行う
            $this->validate($request, $rules);

            $monstercarddetail = new MonsterCardDetail;

            // データベースに保存する
            $monstercarddetail->card_master_id = $last_insert_id;
            $monstercarddetail->property = $request->property;
            $monstercarddetail->tribe = $request->tribe;
            $monstercarddetail->level = $request->level;
            $monstercarddetail->rank = $request->rank;
            $monstercarddetail->scale = $request->scale;
            $monstercarddetail->pendulum_effect = $request->pendulum_effect;
            $monstercarddetail->link = $request->link;
            $monstercarddetail->link_marker = $request->link_marker;
            $monstercarddetail->attack = $request->attack;
            $monstercarddetail->defense = $request->defense;
            $monstercarddetail->save();
            $last_insert_id = $monstercarddetail->id;


            //モンスター種類テーブル
            // Varidationを行う
            $this->validate($request, MonsterCardClass::$rules);

            $monstercardclass = new MonsterCardClass;

            // データベースに保存する
            $monstercardclass->card_master_id = $last_insert_id;
            //$monstercardclass->class_id = $request->class_id;

            $classIdArr = $request->class_id;//$requestからclass_idを取り出して$classIdArrに代入
            foreach ($classIdArr as $ $value) {
              $monstercardclass->class_id = $classIdArr;
              $monstercardclass->save();
            }


        }

        //魔法カードマスタ
        if($request->card_class == "select2"){
            // Varidationを行う
            $this->validate($request, MagicCardDetail::$rules);

            $magiccarddetail = new MagicCardDetail;

            // データベースに保存する
            $magiccarddetail->card_master_id = $last_insert_id;
            $magiccarddetail->magic_card_class = $request->magic_card_class;
            $magiccarddetail->save();
        }

        //罠カードマスタ
        if($request->card_class == "select3"){
            // Varidationを行う
            $this->validate($request, TrapCardDetail::$rules);

            $trapcarddetail = new TrapCardDetail;//$trapcarddetail変数をインスタンス化

            // データベースに保存する
            $trapcarddetail->card_master_id = $last_insert_id;
            $trapcarddetail->trap_card_class = $request->trap_card_class;
            $trapcarddetail->save();
        }

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
