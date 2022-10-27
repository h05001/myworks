<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Facades\Excel;


use App\CardDetail;
use App\MonsterCardDetail;
use App\MonsterCardClass;
use App\MagicCardDetail;
use App\TrapCardDetail;
use App\Tribe;
use App\CardPrice;
use App\RecordingCard;
use Carbon\Carbon;
//use App\Imports\CardDetailsImport as CardDetailImport;


class CardDetailController extends Controller
{
    public function add()
    {
        //$tribelist = tribe::all();
        //$tribelist = DB::table('tribes')->select('tribe_id', 'tribe')->get();
        //dd($tribelist);
/*
        $listarr = array();
        $listarr += array( "" => "種族を選択" ); //listの先頭に追加
        //
        foreach ($tribelist as $lists) {
           $listarr += array( $lists->tribe_id => $lists->tribe );

        }

        dd($listarr);
*/

        $tribelist = \App\Tribe::pluck('tribe', 'tribe_id');
        $tribelist = $tribelist -> prepend('種族を選択', '');

        return view('admin.carddetail.create', [ "tribelist" => $tribelist ]);

    }


    public function create(Request $request)
    {
//
        //$request->input("card_class");
//dd($request);
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
        $last_insert_id = $carddetail->card_master_id;

        //モンスターカードマスタ
        if($request->card_class == "select1"){

            $rules = MonsterCardDetail::getRules($request->class_id);
            $monstercardclass = new MonsterCardClass;

            // Varidationを行う
            //$this->validate($request, $rules);

            $monstercarddetail = new MonsterCardDetail;

            // データベースに保存する
            $monstercarddetail->card_master_id = $last_insert_id;
            $monstercarddetail->property = $request->property;
            $monstercarddetail->tribe_id = $request->tribe_id;
            $monstercarddetail->level_rank_link = $request->level_rank_link;
            $monstercarddetail->scale = $request->scale;
            //$monstercarddetail->scale = $request->CONVERT(int,scale);
            $monstercarddetail->pendulum_effect = $request->pendulum_effect;
            if($request->has("link_marker")){
                $monstercarddetail->link_marker = implode($request->link_marker);
            }
            $monstercarddetail->attack = $request->attack;
            $monstercarddetail->defense = $request->defense;
            $monstercarddetail->save();



            //モンスター種類テーブル
            // Varidationを行う
            $this->validate($request, MonsterCardClass::$rules);


            //$monstercardclass->class_id = $request->class_id;

            $classIdArr = $request->class_id;//$requestからclass_idを取り出して$classIdArrに代入
            foreach ($classIdArr as $value) {//$classIdArrの値の数だけ
              $monstercardclass = new MonsterCardClass;
//dd($last_insert_id);
              // データベースに保存する
              $monstercardclass->card_master_id = $last_insert_id;
              $monstercardclass->class_id = $value;//$monstercardclassからclass_idを取り出して$classIdArrを代入
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
//dd($request);

      $query = CardDetail::query();//CardDetail Modelを使って、データベースに保存されている、card_detailsテーブルの情報を取得し、変数$postsに代入
      $query -> select('card_details.card_master_id as id','card_details.card_name','card_details.ruby','card_details.card_class','card_details.card_text')

             -> leftjoin('monster_card_details', 'card_details.card_master_id', '=', 'monster_card_details.card_master_id')
             -> leftjoin('magic_card_details', 'card_details.card_master_id', '=', 'magic_card_details.card_master_id')
             -> leftjoin('trap_card_details', 'card_details.card_master_id', '=', 'trap_card_details.card_master_id');

             //-> leftjoin('monster_card_details', 'card_details.card_master_id', '=', 'monster_card_details.card_master_id')
             //-> leftjoin('magic_card_details', 'card_details.card_master_id', '=', 'magic_card_details.card_master_id')
             //-> leftjoin('trap_card_details', 'card_details.card_master_id', '=', 'trap_card_details.card_master_id');

      $cond_card_name = $request->cond_card_name;
      $cond_card_class = $request->cond_card_class;
      $cond_magic_card_class = $request->cond_magic_card_class;
      $cond_trap_card_class = $request->cond_trap_card_class;

      $cond_class_id = $request->cond_class_id;

      $cond_property = $request->cond_property;
      $cond_tribe_id = $request->cond_tribe_id;

      $cond_level_rank_link_fr = $request->cond_level_rank_link_fr;
      //dd($cond_level_rank_link_fr);
      $cond_level_rank_link_to = $request->cond_level_rank_link_to;
      $cond_scale_fr = $request->cond_scale_fr;
      $cond_scale_to = $request->cond_scale_to;
      $cond_attack_fr = $request->cond_attack_fr;
      $cond_attack_to = $request->cond_attack_to;
      $cond_defense_fr = $request->cond_defense_fr;
      $cond_defense_to = $request->cond_defense_to;
      $cond_link_marker = $request->cond_link_marker;
      $cond_key_word = $request->cond_key_word;
/*
      $cond_link_marker = '';
      if($request->has("cond_link_marker")){
          $cond_link_marker = implode($request->cond_link_marker);
      }
*/

      if ($cond_card_name != '') {
          // 検索されたら検索結果を取得する
          $query -> where('card_name', 'LIKE', "%{$cond_card_name}%");
      }
      if ($cond_card_class != '') {
          // 検索されたら検索結果を取得する
          $query -> where('card_class', $cond_card_class);
      }

      if ($cond_magic_card_class != '') {
          // 検索されたら検索結果を取得する
          $query -> where('magic_card_class', $cond_magic_card_class);
      }

      if ($cond_trap_card_class != '') {
          // 検索されたら検索結果を取得する
          $query -> where('trap_card_class', $cond_trap_card_class);
      }

      if ($cond_class_id != '') {
//dd($cond_class_id);
//dd($request);
          // 検索されたら検索結果を取得する
          //$query -> where('class_id', 'LIKE', "%{$cond_class_id}%");
          //-> where('class_id', 'LIKE', '%{$cond_class_id}%')
          $query -> whereExists(function ($query1) use ($cond_class_id){
                $query1 -> select('monster_card_classes.card_master_id')
                        -> from('monster_card_classes')
                        -> whereColumn('card_details.card_master_id','=','monster_card_classes.card_master_id')
                        -> where(function($query2) use ($cond_class_id){

                            foreach ( $cond_class_id as $classId){
                                $query2 -> orWhere('class_id', $classId);
                            }

                          //$query2 -> where('class_id', '=', 1 )
                          //        -> orWhere('class_id', '=', 10 );
                        })

                        -> groupBy('monster_card_classes.card_master_id')
                        //-> having('COUNT(`monster_card_classes`.`card_master_id`)' , '>=', 2);
                        -> havingRaw("COUNT( `monster_card_classes`.`card_master_id`) >= ".count($cond_class_id));
                });
      }else{
          $cond_class_id = array();
      }

      if ($cond_property != '') {
          // 検索されたら検索結果を取得する
          $query -> where('property', $cond_property);
      }

      if ($cond_tribe_id != '') {
          // 検索されたら検索結果を取得する
          $query -> where('tribe_id', $cond_tribe_id);
      }

      if ($cond_level_rank_link_fr != '') {//以上
          // 検索されたら検索結果を取得する
          $query -> where('level_rank_link', '>=' ,$cond_level_rank_link_fr);
      }

      if ($cond_level_rank_link_to != '') {//以下
          // 検索されたら検索結果を取得する
          $query -> where('level_rank_link', '<=' ,$cond_level_rank_link_to);
      }

      if ($cond_scale_fr != '') {//以上
          // 検索されたら検索結果を取得する
          $query -> where('scale', '>=' ,$cond_scale_fr);
      }

      if ($cond_scale_to != '') {//以下
          // 検索されたら検索結果を取得する
          $query -> where('scale', '<=' ,$cond_scale_to);
      }

      if ($cond_attack_fr != '') {//以上
          // 検索されたら検索結果を取得する
          $query -> where('attack', '>=' ,$cond_attack_fr);
      }

      if ($cond_attack_to != '') {//以下
          // 検索されたら検索結果を取得する
          $query -> where('attack', '<=' ,$cond_attack_to);
      }

      if ($cond_defense_fr != '') {//以上
          // 検索されたら検索結果を取得する
          $query -> where('defense', '>=' ,$cond_defense_fr);
      }

      if ($cond_defense_to != '') {//以下
          // 検索されたら検索結果を取得する
          $query -> where('defense', '<=' ,$cond_defense_to);
      }

      if ($cond_link_marker != '') {
          // 検索されたら検索結果を取得する
          foreach ($cond_link_marker as $link_markers) {
              $query -> where('link_marker', 'LIKE', "%{$link_markers}%");
          }

          //$query -> where('link_marker', 'LIKE', "%{$cond_link_marker}%");
      }else{
          $cond_link_marker = array();
      }

      if ($cond_key_word != '') {
          // 検索されたら検索結果を取得する
          $query -> where(function($query2) use ($cond_key_word) {
                  $query2 -> orWhere('card_name', 'LIKE', "%{$cond_key_word}%")
                          -> orWhere('ruby', 'LIKE', "%{$cond_key_word}%")
                          -> orWhere('card_text', 'LIKE', "%{$cond_key_word}%");
                  });

      }
//dd($cond_tribe_id);
//dd($query->getBindings());
//dd($query->toSql(), $query->getBindings());
      $posts = $query -> get();

      $tribelist = \App\Tribe::pluck('tribe', 'tribe_id');
      $tribelist = $tribelist -> prepend('種族を選択', '');

      return view('admin.carddetail.index', ['posts' => $posts,
                                             'cond_card_name' => $cond_card_name,
                                             'cond_card_class' => $cond_card_class,
                                             'cond_magic_card_class' => $cond_magic_card_class,
                                             'cond_trap_card_class' => $cond_trap_card_class,
                                             'cond_class_id' => $cond_class_id,
                                             'cond_property' => $cond_property,
                                             'cond_tribe_id' => $cond_tribe_id,
                                             'cond_level_rank_link_fr' => $cond_level_rank_link_fr,
                                             'cond_level_rank_link_to' => $cond_level_rank_link_to,
                                             'cond_scale_fr' => $cond_scale_fr,
                                             'cond_scale_to' => $cond_scale_to,
                                             'cond_attack_fr' => $cond_attack_fr,
                                             'cond_attack_to' => $cond_attack_to,
                                             'cond_defense_fr' => $cond_defense_fr,
                                             'cond_defense_to' => $cond_defense_to,
                                             'cond_link_marker' => $cond_link_marker,
                                             'cond_key_word' => $cond_key_word,
                                              "tribelist" => $tribelist
                                            ]);

      }

      public function detail(Request $request)
      {
          $posts = CardDetail::find($request -> id);
          //dd(get_class($posts->monstercardclasses));
          //dd($posts->trapcarddetails);
          return view('admin.carddetail.detail', ['posts' => $posts]);

      }

      public function price(Request $request)
      {
          $carddetail = Carddetail::find($request -> id);

          $subquery = RecordingCard::leftjoin('card_prices','recording_cards.id', '=', 'card_prices.recordingcard_id')
                                   ->select('recording_cards.id',
                                            'card_prices.notes',
                                             DB::raw('MAX(card_prices.created_at) as created_at'),
                                            'card_prices.cardshop_id'
                                           )
                                   ->groupBy('recording_cards.id','card_prices.notes','card_prices.cardshop_id');

          $lastprice =  RecordingCard::leftjoin('card_prices','recording_cards.id', '=', 'card_prices.recordingcard_id')
                                     ->leftjoin('rarities', 'recording_cards.rarity_id', '=', 'rarities.id')
                                     ->leftjoin('card_shops', 'card_prices.cardshop_id', '=', 'card_shops.id')
                                     ->leftjoin('recording_packs','recording_cards.recordingpackid', '=', 'recording_packs.id')

                                     -> joinsub($subquery,'T1',function($join){
                                         $join->on('recording_cards.id', '=', 'T1.id')
                                              ->whereRaw('T1.created_at = card_prices.created_at')
                                              ->whereRaw('IFNULL(T1.notes,0) = IFNULL(card_prices.notes,0)')
                                              ->whereRaw('T1. cardshop_id = card_prices.cardshop_id')
                                         ;})
                                      ->select('recording_cards.id',
                                               'recording_cards.cardname',
                                               'recording_cards.recordingcardid',
                                               'recording_cards.recordingpackid',
                                               'recording_cards.rarity_id',
                                               'card_prices.cardprice',
                                               'card_prices.cardshop_id',
                                               'card_prices.notes',
                                               'card_prices.created_at',
                                               'rarities.rarity_jp',
                                               'card_shops.cardshop',
                                               'recording_packs.recordingpack')
                                    ->where('recording_cards.card_master_id',$request -> id)
                                    ->orderby('rarities.id','desc')
                                    ->get();

          $rarity_list = array_column((array)json_decode($lastprice), 'rarity_jp','id');
          //dd($rarity_list);
//dd($lastprice);
          return view('admin.carddetail.price', ['carddetail' => $carddetail,
                                                 'lastprice' => $lastprice,
                                                 'rarity_list' => $rarity_list,
                                                 //'priceHistory' => $priceHistory
                                                 ]);

      }

      public function history(Request $request)
      {

//dd($request);
          $month = 1;
          if($request-> term != null){
              $month = $request-> term;
          }
          $date = Carbon::today()->subMonth($month);

          $priceHistory = CardPrice::leftjoin('recording_cards','card_prices.recordingcard_id', '=', 'recording_cards.id')

                                   ->select('card_prices.id',
                                            'card_prices.cardprice',
                                            'card_prices.notes',
                                            'card_prices.created_at',
                                            'card_prices.cardshop_id')

                                   ->where('recording_cards.id',$request -> id)
                                   ->where('card_prices.cardshop_id',$request -> cardshop_id)
                                   ->whereNull('notes')
                                   ->whereDate('card_prices.created_at', '>=', $date)
                                   ->get();
                                   //->toSql();
//var_dump($priceHistory);
//dd($priceHistory);
//dd($priceHistory->getBindings());
                  // ソート済みの配列を返す

         $id = $request -> id;
         //$keys = array_column((array)json_decode($priceHistory),'get_date');
         $keys = array_column((array)json_decode($priceHistory),'created_at');

         $counts = array_column((array)json_decode($priceHistory),'cardprice');

         $cardshop_id = $request -> cardshop_id;

         return view('admin.carddetail.history',compact('keys','counts','id','cardshop_id'));
      }

      public function historyAvg(Request $request)
      {

//dd($request);
          $month = 1;
          if($request-> term != null){
              $month = $request-> term;
          }
          $date = Carbon::today()->subMonth($month);

          $priceHistoryAvg = CardPrice::selectRaw('DATE_FORMAT(created_at, "%Y/%m/%d") AS date')
                                      ->selectRaw('MAX(cardprice) as max')
                                      ->selectRaw('ROUND(AVG(cardprice)) as avg')
                                      ->selectRaw('MIN(cardprice) as min')
                                      ->groupBy('date')

                                      ->where('card_prices.recordingcard_id',$request -> id)

                                      ->whereNull('notes')
                                      ->whereDate('card_prices.created_at', '>=', $date)
                                      ->get();
//dd($priceHistoryAvg);
                  // ソート済みの配列を返す

         $id = $request -> id;
         //$keys = array_column((array)json_decode($priceHistory),'get_date');
         $keys = array_column((array)json_decode($priceHistoryAvg),'date');

         $maxPrices = array_column((array)json_decode($priceHistoryAvg),'max');
         $avgPrices = array_column((array)json_decode($priceHistoryAvg),'avg');
         $minPrices = array_column((array)json_decode($priceHistoryAvg),'min');

         return view('admin.carddetail.historyAvg',compact('keys','maxPrices','avgPrices','minPrices','id'));
      }

      public function import(Request $request)
      {
        $file = $request->file('import');

        $import = new \SplFileObject($file);
        $import->setFlags(
            \SplFileObject::READ_CSV |      // CSVとして行を読み込み
            \SplFileObject::READ_AHEAD |    // 先読み／巻き戻しで読み込み
            \SplFileObject::SKIP_EMPTY |    // 空行を読み飛ばす
            \SplFileObject::DROP_NEW_LINE   // 行末の改行を読み飛ばす
        );


        if($request->file_class == "select1"){
            $this -> importMonsterCard($import);
        }
        if($request->file_class == "select2"){
            $this -> importMagicCard($import);
        }
        if($request->file_class == "select3"){
            $this -> importTrapCard($import);
        }
        if($request->file_class == "select4"){
            $this -> importCardPrice($import);
        }


        return redirect('admin/carddetail')->with('flash_message', '登録が完了しました');
    }

    public function importMonsterCard($import_data)
    {
      $import_flag = false;

      $import_data->seek(PHP_INT_MAX);
      //dd($import_data->key() + 1);
      foreach($import_data as $row) {
          if (!$import_flag ){
          $import_flag = true;
          continue;
        }
        // 文字コード変換
        $row = mb_convert_encoding($row, "UTF-8","sjis-win, sjis");
        $import = CardDetail::create([
          'card_name' => $row[0],
          'ruby' => $row[1],
          'card_class' => "select1",
          'card_text' => $row[2],
        ]);

        $monsterCardclassArr = explode("_",$row[3]);

        foreach ($monsterCardclassArr as $monsterCardclass) {
          $monstercardclass = new MonsterCardClass;

          // データベースに保存する
          $monstercardclass->card_master_id = $import-> card_master_id;
          $monstercardclass->class_id = (int)$monsterCardclass;
          $monstercardclass->save();
          /*
          MonsterCardclass::create([
            'card_master_id' => $import-> card_master_id,
            'class_id' => $monsterCardclass
          ]);*/
        }
        $monstercarddetail = new MonsterCardDetail;

        // データベースに保存する
        $monstercarddetail->card_master_id = $import-> card_master_id;
        $monstercarddetail->property = $row[4];
        $monstercarddetail->tribe_id = (int)$row[5];
        $monstercarddetail->level_rank_link = (int)$row[6];
        $monstercarddetail->scale = (int)$row[7];

        $monstercarddetail->pendulum_effect = $row[8];

        $monstercarddetail->link_marker = $row[9];

        $monstercarddetail->attack = $row[10];
        $monstercarddetail->defense = $row[11];
        $monstercarddetail->save();

      }
    }

      public function importMagicCard($import_data)
      {
        $import_flag = false;
        foreach($import_data as $row) {
          if (!$import_flag ){
            $import_flag = true;
            continue;
          }
          // 文字コード変換
          $row = mb_convert_encoding($row, "UTF-8","sjis-win, sjis");
          $import = CardDetail::create([
            'card_name' => $row[0],
            'ruby' => $row[1],
            'card_class' => "select2",
            'card_text' => $row[2],
          ]);
//dd($import);
          $magiccarddetail = new MagicCardDetail;//$magiccarddetail変数をインスタンス化

          // データベースに保存する
          $magiccarddetail->card_master_id = $import-> card_master_id;
          $magiccarddetail->magic_card_class = $row[3];
          $magiccarddetail->save();

        }
      }

        public function importTrapCard($import_data)
        {
          $import_flag = false;
          foreach($import_data as $row) {
            if (!$import_flag ){
              $import_flag = true;
              continue;
            }

            // 文字コード変換
            $row = mb_convert_encoding($row, "UTF-8","sjis-win, sjis");

            $import = CardDetail::create([
              'card_name' => $row[0],
              'ruby' => $row[1],
              'card_class' => "select3",
              'card_text' => $row[2],
            ]);

            $trapcarddetail = new TrapCardDetail;//$trapcarddetail変数をインスタンス化

            // データベースに保存する
            $trapcarddetail->card_master_id = $import-> card_master_id;
            $trapcarddetail->trap_card_class = $row[3];
            $trapcarddetail->save();
          }
        }

        public function importCardPrice($import_data)
        {
          $import_flag = false;
          foreach($import_data as $row) {
            if (!$import_flag ){
              $import_flag = true;
              continue;
            }
            // 文字コード変換
            $row = mb_convert_encoding($row, "UTF-8","sjis-win, sjis");
            $recordingcard = new RecordingCard;//$recordingcard変数をインスタンス化

            // データベースに保存する
            $recordingcard->cardname = $row[0];
            //$recordingcard->card_master_id = $row[1];
            $card_master_id = CardDetail::select('card_details.card_name',
                                                 'card_details.card_master_id')
                                           ->where($row[0])
                                           ->get();
            $recordingcard->card_master_id = $card_master_id->card_master_id;
            $recordingcard->recordingpackid = $row[1];
            $recordingcard->recordingcardid = $row[2];
            $recordingcard->rarity_id = (int)$row[3];
            $recordingcard->save();
            /*
            $import = CardPrice::create([
              'cardname' => $row[0],
              'card_master_id' => $row[1],
              'recordingpackid' => $row[2],
              'recordingcardid' => $row[3],
              'rarity_id' => (int)$row[4]
            ]);*/


          }
        }
}
