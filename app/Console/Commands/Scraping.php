<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Weidner\Goutte\GoutteFacade as GoutteFacade;
use App\RecordingCard;
use App\CardPrice;
use App\CardShop;

class Scraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

     //スクレイピング
     protected $signature = 'command:scraping {conditions=null}{shop_list=null}';
     //protected $signature = 'command:scraping {conditions?}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $logger = \Log::channel('batch')->getLogger();
      $logger->info("スクレイピング開始");

        try {
            $start = microtime(true);
            if($this->argument('shop_list') != "null" ){
//$logger->info(gettype($this->argument('shop_list')));
                $shop_list = CardShop::whereIn('id', json_decode($this->argument('shop_list')))->get();

            }else{
                $shop_list = CardShop::get();
                //$logger->info("null");
            }

            foreach ($shop_list as $shop) {
                print_r( 'ShopID:' .$shop ->id." "."開始"."\n" );
                $logger->info('ShopID:' .$shop ->id."開始");
                //$logger->info($shop);
            /*
              // TODO: テスト用 ショップid2の開発が終わったら消す
              if ($shop ->id == 1) {
                continue;
              }
            */
                $site_url = $shop->URL;

                if($this->argument('conditions') != 'null'){
                    $query = RecordingCard::select('recording_cards.recordingcardid','recording_packs.id')
                                          ->leftjoin('recording_packs','recording_cards.recordingpackid', '=', 'recording_packs.id');

                        $pack = json_decode($this->argument('conditions'));
                        $query ->where(function($query2) use ($pack){
                            foreach ( $pack as $value){
                                $query2 -> orWhere('recording_packs.id', $value);
                            }
                        });

                    $keyword = $query->get();

                }else{
                    $keyword = RecordingCard::select('recordingcardid')->get();

                }

                $keyword = $keyword->unique('recordingcardid');

                foreach ($keyword as  $keywords) {
                        print_r( '対象ID:' .$keywords->recordingcardid." " );
                        //$logger->info('対象ID:' .$keywords->recordingcardid);

                        $url = $site_url.$keywords->recordingcardid;

                        $goutte = GoutteFacade::request('GET', $url);
                        $goutte ->text();

                        if($shop ->id == 1){
                            $this->scraping_c_labo($goutte,$shop ->id,$keywords->recordingcardid);

                        }

                        if($shop ->id == 2){
                            $this->scraping_amenityDream($goutte,$shop ->id,$keywords->recordingcardid);

                        }
                        if($shop ->id == 3){
                            $this->scraping_yuyutei($goutte,$shop ->id,$keywords->recordingcardid);

                        }
                        $end = microtime(true);
                        print_r( '処理時間 = ' . ($end - $start) . '秒'."\n" );
                        $logger->info('対象ID:' .$keywords->recordingcardid." " .'処理時間 = ' . ($end - $start) . '秒' );
                  }
                  print_r( 'ShopID:' .$shop ->id." "."\n" );
                  $logger->info('ShopID:' .$shop ->id."終了");
              }

        } catch (\Exception $e) {
            \Log::error($e);

        }

        $logger->info("スクレイピング完了");
    }


    public function save_card_price($shop_id,$recordingcardid,$rarities,$prices,$notes)
    {
        // データベースに保存する
        try{
          $check = RecordingCard :: leftjoin('rarities', 'recording_cards.rarity_id', '=', 'rarities.id')
                                 -> leftjoin('rarity_converts', 'recording_cards.rarity_id', '=', 'rarity_converts.rarity_id')
                                 -> select('recording_cards.*')
                                 -> where('recordingcardid',$recordingcardid)
                                 -> where('shop_id',$shop_id)
                                 -> where('rarity_convert',$rarities)
                                 -> first();

//dd($check->toSql()

        $cardprice = new CardPrice;
        $cardprice->cardshop_id = $shop_id;
        $cardprice->recordingcard_id = $check->id;
        $cardprice->cardprice = $prices;
        $cardprice->notes = $notes;
        $cardprice->save();
      }catch(\Exception $e){
        $logger = \Log::channel('batch')->getLogger();
        $logger->info($rarities);
        $logger->info($e);
        print_r($rarities);
      }
    }

    /***
    * カードラボ用のスクレイビング処理
    *
    * @param int $shop_id 店舗のid(int)
    */
    public function scraping_c_labo($goutte,$shop_id,$recordingcardid)
    {
      // 無名関数(クロージャ)
      $goutte ->filter('div.item_data')->each(function ($div)use ($shop_id,$recordingcardid) {

          $rarity = $div->filter('span.goods_name')->text();
          $rarity_s = mb_strpos($rarity, "】");
          $rarity_start = mb_strpos($rarity, "【",$rarity_s )+1;
          $rarity_end = mb_strpos($rarity, "/" , $rarity_s)-$rarity_start;
          $rarities = mb_substr($rarity, $rarity_start , $rarity_end);


          $price = $div->filter('span.figure')->text();
          $prices = str_replace("円","",$price);
          $prices = (int)str_replace(",","",$prices);


          //キズあり特価品
          $note = $div->filter('span.goods_name')->text();
          $note_start = mb_strpos($note, "《",1)+1;
          $note_end = mb_strpos($note, "》" , 1)-$note_start;
          $notes = null;

          if(1 <= $note_end){
              $notes = mb_substr($note, $note_start , $note_end);
          }

          //イラスト違い
          $illust = $div->filter('span.goods_name')->text();
          $illust_start = mb_strpos($illust, "(",1)+1;
          $illust_end = mb_strpos($illust, ")" , 1)-$illust_start;
          $illusts = null;

          if(1 <= $illust_end){
              $illusts = mb_substr($illust, $illust_start , $illust_end);
              if ($notes != null ) {
                  $notes = $notes."/";
              }
              $notes = $notes.$illusts;
          }

          
          $this->save_card_price($shop_id,$recordingcardid,$rarities,$prices,$notes);

      });

    }

    //アメニティードリームのスクレイピング
    public function scraping_amenityDream($goutte,$shop_id,$recordingcardid)
    {
      // 無名関数(クロージャ)
      $goutte ->filter('div.item_data')->each(function ($div)use ($shop_id,$recordingcardid) {
          $prices = null;
          $rarity = $div->filter('span.goods_name')->text();
          $rarity_s = mb_strpos($rarity, "【");
          $rarity_start = mb_strpos($rarity, "【",$rarity_s )+1;
          $rarity_end = mb_strpos($rarity, "】" , $rarity_s)-$rarity_start;
          $rarities = mb_substr($rarity, $rarity_start , $rarity_end);
          if(count($div->filter('span.figure'))){
              $price = $div->filter('span.figure')->text();
              $prices = str_replace("円","",$price);
              $prices = (int)str_replace(",","",$prices);
          }else{
              return;
          }
          $notes = null;

            $this->save_card_price($shop_id,$recordingcardid,$rarities,$prices,$notes);
      });

    }

    public function scraping_yuyutei($goutte,$shop_id,$recordingcardid)
    {
      // 無名関数(クロージャ)
      $goutte ->filter('div.card_list_box')->each(function ($div)use ($shop_id,$recordingcardid) {

          $rarities = $div->filter('em.gr_color')->text();
          $rarities = str_replace(array("\r\n", "\r", "\n"), '', $rarities);

          $price = $div->filter('p.price')->text();
          $prices = (int)str_replace("円","",$price);
          $notes = null;
          //print_r( 'レアリティ：' .$rarity);
          //print_r( '価格：' .$prices);


          $this->save_card_price($shop_id,$recordingcardid,$rarities,$prices,$notes);

        });

    }
}
