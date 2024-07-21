<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;

use App\CardDetail;
use App\MonsterCardDetail;
use App\MonsterCardClass;
use App\MagicCardDetail;
use App\TrapCardDetail;
use App\Tribe;
use App\CardPrice;
use App\RecordingCard;
use App\TournamentDeckCard;
use App\Regulation;
use Carbon\Carbon;
use \Artisan;
use Illuminate\Support\Facades\Log;
use Validator;
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
*/

        $tribelist = \App\Tribe::pluck('tribe', 'tribe_id');
        $tribelist = $tribelist -> prepend('種族を選択', '');

        return view('admin.carddetail.create', [ "tribelist" => $tribelist ]);

    }


    public function create(Request $request)
    {

        try {
            $check = CardDetail::where('card_name', $request->card_name)->get();
            //dd($check);
            if ($check -> isNotEmpty()) {
                return redirect('admin/carddetail/create')->withErrors('登録済みです');
            }
            DB::beginTransaction();


            // データベース操作
            $messeage = [
              'card_name' => 'card_name：未入力です',
              'ruby' => 'ruby：未入力です',
              'card_class' => 'カードの種類：選択してください',
              'card_text' => 'card_text：未入力です',
            ];
            //カードマスタ
            // Varidationを行う
            $this->validate($request, CardDetail::$rules2,$messeage);

            $carddetail = new CardDetail;

            // データベースに保存する
            $carddetail->card_name = $request->card_name;
            $carddetail->ruby = $request->ruby;
            $carddetail->card_class = $request->card_class;
            $carddetail->image_path = $request->image_path;
            $carddetail->card_text = $request->card_text;
            $carddetail->save();
            $last_insert_id = $carddetail->card_master_id;



            //カードマスタにデータを登録すると同時にデッキマスタに登録済みのデータをcard_nameで検索してnullになっているカードマスタIDを上書き
            TournamentDeckCard::where('card_name', $request->card_name)
                              ->whereNull('card_master_id')
                              ->update(['card_master_id' => $last_insert_id]);

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

            DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
//dd($e);
          if($e instanceof ValidationException){
              throw $e;
          }

          // 例外処理
          // ...
        }

        return redirect('admin/carddetail/create');
  }

    public function edit(Request $request)
  {
      //dd($request);
      $carddetail = CardDetail::find($request->id);

      // $monstercardclass = MonsterCardClass::select('class_id')
      //                                     ->where('card_master_id', '=', $request->id)->get();
      // $monstercardclass = $monstercardclass->toArray();
      //dd($monstercardclass);
      // foreach ($monstercardclass as $array) {
      //     foreach ($array as $value) {
      //
      //         if ($value == 12) {
      //             $monstercarddetail = MonsterCardDetail::where('card_master_id', '=', $request->id)->get();
      //         }
      //     }
      //
      // }
      //dd($carddetail -> monstercardclasses -> class_id);

      //$old_card_text = $carddetail -> card_text;

      //return view('admin.carddetail.update',['old_card_text' => $old_card_text, 'monstercarddetail' => $monstercarddetail]);
      return view('admin.carddetail.update',['carddetail' => $carddetail]);
  }

    public function update(Request $request)
  {
//

      // Modelから更新前データを取得する
      $carddetail = CardDetail::find($request->card_master_id);
      $old_card_text =  $carddetail -> card_text;


      $new_card_text = $request -> card_text;







      // 該当するデータを上書きして保存する
      $carddetail -> card_text = $new_card_text;
      $carddetail->save();

      return view('admin.carddetail.detail', ['posts' => $posts, 'transitions' => $transitions]);
  }

  public function index(Request $request)
  {

      $query = CardDetail::query();//CardDetail Modelを使って、データベースに保存されている、card_detailsテーブルの情報を取得し、変数$postsに代入
      $query -> select('card_details.card_master_id as id','card_details.card_name','card_details.ruby','card_details.card_class','card_details.card_text')
             //-> leftjoin('regulations', 'card_details.card_master_id', '=', 'regulations.card_master_id')
             -> leftjoin('monster_card_details', 'card_details.card_master_id', '=', 'monster_card_details.card_master_id')
             -> leftjoin('magic_card_details', 'card_details.card_master_id', '=', 'magic_card_details.card_master_id')
             -> leftjoin('trap_card_details', 'card_details.card_master_id', '=', 'trap_card_details.card_master_id');

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

          // 検索されたら検索結果を取得する

          $query -> whereExists(function ($query1) use ($cond_class_id){
                $query1 -> select('monster_card_classes.card_master_id')
                        -> from('monster_card_classes')
                        -> whereColumn('card_details.card_master_id','=','monster_card_classes.card_master_id')
                        -> where(function($query2) use ($cond_class_id){

                            foreach ( $cond_class_id as $classId){
                                $query2 -> orWhere('class_id', $classId);
                            }

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

      $posts = $query -> get();
//dd($posts);
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
          $transitions = Regulation::where('card_master_id',$request->id )->orderBy('regulation_id','desc')->get();

          return view('admin.carddetail.detail', ['posts' => $posts, 'transitions' => $transitions]);

      }

      public function price(Request $request)
      {

          $carddetail = Carddetail::find($request -> id);
//dd($carddetail);
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

          return view('admin.carddetail.price', ['carddetail' => $carddetail,
                                                 'lastprice' => $lastprice,
                                                 'rarity_list' => $rarity_list,
                                                 //'priceHistory' => $priceHistory
                                                 ]);

      }

      public function history(Request $request)
      {

//dd($request);
          $term = $request -> term;
          //dd($term);
          $note = $request -> note;

          if($request-> term == null){
              $term = Carbon::today()->subYear();
          }
          //$date = Carbon::today()->subMonth($month);

          $priceHistory = CardPrice::leftjoin('recording_cards','card_prices.recordingcard_id', '=', 'recording_cards.id')

                                   ->select('card_prices.id',
                                            'card_prices.cardprice',
                                            'card_prices.notes',
                                            'card_prices.created_at',
                                            'card_prices.cardshop_id')

                                   ->where('recording_cards.id',$request -> id)
                                   ->where('card_prices.cardshop_id',$request -> cardshop_id)
                                   //->whereNull('notes')
                                   ->where('card_prices.notes',$note)
                                   ->whereDate('card_prices.created_at', '>=', $term)
                                   ->get();

                  // ソート済みの配列を返す

         $id = $request -> id;
         //$keys = array_column((array)json_decode($priceHistory),'get_date');
         $keys = array_column((array)json_decode($priceHistory),'created_at');

         $counts = array_column((array)json_decode($priceHistory),'cardprice');

         $cardshop_id = $request -> cardshop_id;
         $notes = $request -> notes;
         //dd($notes);
         return view('admin.carddetail.history',compact('keys','counts','id','cardshop_id','note','term'));
      }

      public function historyAvg(Request $request)
      {

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

                                      //->whereNull('notes')
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

        DB::beginTransaction();
        try {
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
            if($request->file_class == "select5"){
                $this -> importRegulation($import);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
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
        $check = mb_detect_encoding($row[0],"UTF-8");
        //dd($check);
        if($check === false){
            $row = mb_convert_encoding($row, "UTF-8","sjis-win, sjis, Shift-JIS");

        }
        //データ重複チェック
        $duplication = CardDetail::where('card_name', $row[0])->get();

        if ($duplication -> isNotEmpty()) {

            continue;
        } else {
            $carddetail = new CardDetail;

            // データベースに保存する
            $carddetail->card_name = $row[0];
            $carddetail->ruby = $row[1];
            $carddetail->card_class = "select1";
            $carddetail->card_text = $row[2];

            //$monstercardclass->card_master_id = $last_insert_id;
            //$monstercardclass->class_id = $row[3];
            $monsterCardclassArr = explode("_",$row[3]);

            $monstercarddetail = new MonsterCardDetail;

            $monstercarddetail->property = $row[4];
            $monstercarddetail->tribe_id = (int)$row[5];
            $monstercarddetail->level_rank_link = (int)$row[6];

            if($row[7] === ""){
                $row[7] = NULL;
            }
            $monstercarddetail->scale = $row[7];

            if($row[8] === ""){
                $row[8] = NULL;
            }
            $monstercarddetail->pendulum_effect = $row[8];

            if($row[9] === ""){
                $row[9] = NULL;
            }
            $monstercarddetail->link_marker = $row[9];
            $monstercarddetail->attack = $row[10];
            $monstercarddetail->defense = $row[11];
            if($row[11] === ""){
                $row[11] = NULL;
            }
            $monstercarddetail->defense = $row[11];

            $carddetail_arr = $carddetail->toArray();

            $monstercarddetail_arr = $monstercarddetail->toArray();
//dd($monstercardclass_arr);
            $monster_import = array_merge($carddetail_arr, $monstercarddetail_arr);
            $monster_import += ["class_id" => $monsterCardclassArr];
            //dd($monster_import);
            $carddetail_rule = CardDetail::$rules2;
            $monstercardclass_rule = MonsterCardClass::$rules;
//dd($monsterCardclassArr);
            $monstercarddetail_rule = MonsterCardDetail::getRules($monsterCardclassArr);


            $rules = $carddetail_rule + $monstercardclass_rule + $monstercarddetail_rule;

            $validator = Validator::make($monster_import, $rules);
//dd($validator);
            if ($validator->fails()) {
//dd("失敗");
                return redirect('admin/carddetail/index')->withErrors($mess);

            } else {
//dd("test");
              // データベースに保存する
                $carddetail->save();
                $last_insert_id = $carddetail->card_master_id;
                foreach ($monsterCardclassArr as $value) {//$classIdArrの値の数だけ

                  $monstercardclass = new MonsterCardClass;
                  $monstercardclass->card_master_id = $last_insert_id;
                  $monstercardclass->class_id = $value;//$monstercardclassからclass_idを取り出して$classIdArrを代入

                  $monstercardclass->save();
                }
                $monstercarddetail->card_master_id = $last_insert_id;
                $monstercarddetail->save();

            }


        }

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
          $check = mb_detect_encoding($row[0],"UTF-8");
          if(mb_detect_encoding($row[0]) === false){
              $row = mb_convert_encoding($row, "UTF-8","sjis-win, sjis, Shift-JIS, UTF-8");
          }
          $duplication = CardDetail::where('card_name', $row[0])->get();
          //dd($check);
          if ($duplication -> isNotEmpty()) {
              continue;
          } else {
              $carddetail = new CardDetail;

              // データベースに保存する
              $carddetail->card_name = $row[0];
              $carddetail->ruby = $row[1];
              $carddetail->card_class = "select2";

              $carddetail->card_text = $row[2];

              $validator = Validator::make($carddetail->toArray(), CardDetail::$rules2);

              if ($validator->fails()) {
//dd("失敗");
                  return redirect('admin/carddetail/index')->withErrors($mess);

              } else {

                  $carddetail->save();
                  $last_insert_id = $carddetail->card_master_id;
                  //dd($last_insert_id);
              }

              // $import = CardDetail::create([
              //   'card_name' => $row[0],
              //   'ruby' => $row[1],
              //   'card_class' => "select2",
              //   'card_text' => $row[2],
              // ]);
    //dd($import);
              $magiccarddetail = new MagicCardDetail;//$magiccarddetail変数をインスタンス化

              // データベースに保存する
              $magiccarddetail->card_master_id = $last_insert_id;
              $magiccarddetail->magic_card_class = $row[3];
              $validator = Validator::make($magiccarddetail->toArray(), MagicCardDetail::$rules);

              if ($validator->fails()) {
//dd("失敗");
                  return redirect('admin/carddetail/index')->withErrors($mess);

              } else {
                  $magiccarddetail->save();
              }

          }
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
            $check = mb_detect_encoding($row[0],"UTF-8");
            if(mb_detect_encoding($row[0]) === false){
                $row = mb_convert_encoding($row, "UTF-8","sjis-win, sjis, Shift-JIS, UTF-8");
            }
            $duplication = CardDetail::where('card_name', $row[0])->get();
            //dd($check);
            if ($duplication -> isNotEmpty()) {
                continue;
            } else {
                $carddetail = new CardDetail;

                // データベースに保存する
                $carddetail->card_name = $row[0];
                $carddetail->ruby = $row[1];
                $carddetail->card_class = "select3";
                $carddetail->card_text = $row[2];

                $validator = Validator::make($carddetail->toArray(), CardDetail::$rules2);

                if ($validator->fails()) {
  //dd("失敗");
                    return redirect('admin/carddetail/index')->withErrors($mess);

                } else {

                    $carddetail->save();
                    $last_insert_id = $carddetail->card_master_id;
                    //dd($last_insert_id);
                }

                // $import = CardDetail::create([
                //   'card_name' => $row[0],
                //   'ruby' => $row[1],
                //   'card_class' => "select3",
                //   'card_text' => $row[2],
                // ]);

                $trapcarddetail = new TrapCardDetail;//$trapcarddetail変数をインスタンス化

                // データベースに保存する
                $trapcarddetail->card_master_id = $last_insert_id;
                $trapcarddetail->trap_card_class = $row[3];
                $validator = Validator::make($trapcarddetail->toArray(), TrapCardDetail::$rules);

                if ($validator->fails()) {
  //dd("失敗");
                    return redirect('admin/carddetail/index')->withErrors($mess);

                } else {
                    $trapcarddetail->save();
                }

            }
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
            //$rowの文字コードを取得
            $check = mb_detect_encoding($row[0],"UTF-8");
            if(mb_detect_encoding($row[0]) === false){
                $row = mb_convert_encoding($row, "UTF-8","sjis-win, sjis, Shift-JIS, UTF-8");
            }
              // $check = mb_detect_encoding($row[0]);
              // dd($check);

              $recordingcard = new RecordingCard;//$recordingcard変数をインスタンス化

              // データベースに保存する
              $recordingcard->cardname = $row[0];

              $card_master_id = CardDetail::select('card_details.card_name',
                                                   'card_details.card_master_id')
                                          ->where('card_details.card_name',$row[0])
                                          ->first();

              if($card_master_id == null){
                //Log::info($card_master_id);
                //Log::info($row[0]);
                continue;
              }
              $recordingcard->card_master_id = $card_master_id->card_master_id;
              $recordingcard->recordingpackid = $row[1];
              $recordingcard->recordingcardid = $row[2];
              $recordingcard->rarity_id = (int)$row[3];
              $validator = Validator::make($recordingcard->toArray(), RecordingCard::$rules);

              if ($validator->fails()) {
//dd("失敗");
                  return redirect('admin/carddetail/index')->withErrors($mess);

              } else {
//dd("成功");
                  $recordingcard->save();
              }


          }
        }

        public function importRegulation($import_data)
        {
          $import_flag = false;
          foreach($import_data as $row) {
            if (!$import_flag ){
              $import_flag = true;
              continue;
            }

            // 文字コード変換
            $check = mb_detect_encoding($row[0],"UTF-8");
            if($check === false){
                $row = mb_convert_encoding($row, "UTF-8","sjis-win, sjis, Shift-JIS, UTF-8");
            }
            // $card_master_id = CardDetail::select('card_master_id')
            //                             ->where('card_name', $row[2])
            //                             ->get();
            $card_master_id = CardDetail::where('card_name', $row[2])
                                        ->value('card_master_id');

//dd($card_master_id);
            $import = Regulation::create([
              'regulation_id' => $row[0],
              'card_master_id' => $card_master_id,
              'card_name' => $row[2],
              'able' => $row[3],

            ]);

          }
        }

        public function importRegulationUpdate($import_data)
        {




        }

        public function scrapingConditions(Request $request)
        {
          //dd($request);
            $shop_list = \App\CardShop::pluck('cardshop', 'id');

            //$recordingpack_list = \App\RecordingPack::orderBy('category', 'asc')->orderBy('recordingpackid', 'asc')->pluck('recordingpack', 'id');
            $recordingpack_list = \App\RecordingPack::orderBy('category', 'asc')->orderBy('recordingpackid', 'asc')->get();
            //dd($recordingpack_list);
            //return view('admin.carddetail.scrapingConditions',compact('shop_list','recordingpack_list'));
            return view('admin.carddetail.scrapingConditions', [ "shop_list" => $shop_list,
                                                                 "recordingpack_list" => $recordingpack_list
                                                                ]);
        }

        public function scraping(Request $request)
        {

          $conditions = json_encode($request->recordingpack);
          $shop_list = json_encode($request->shop);



            Artisan::call('command:scraping', ['conditions' => $conditions,
                                               'shop_list' => $shop_list
                                              ]);

            //return redirect('admin.carddetail.scrapingConditions');
        }
}
