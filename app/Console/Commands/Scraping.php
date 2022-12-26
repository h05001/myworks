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
     //protected $signature = 'command:scraping';
     protected $signature = 'command:scraping {conditions?}{shop_list?}';
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
            if($this->argument('shop_list') != null){
                $shop_list = $this->argument('shop_list');

            }else{
                $shop_list = CardShop::select('id')->get();
            }

            foreach ($shop_list as $shop) {
            /*
              // TODO: テスト用 ショップid2の開発が終わったら消す
              if ($shop ->id == 1) {
                continue;
              }
            */
                $site_url = $shop->URL;
                $keyword = RecordingCard::select('recordingcardid')->get();
                $keyword = $keyword->unique('recordingcardid');
                if($this->argument('conditions') != null){
                    $keyword = RecordingCard::select('recordingcardid')->where("recordingcardid",$this->argument('recordingcardid'))->get();

                }

                //$keyword = RecordingCard::select('recordingcardid')->where('recordingcardid',"AC02-JP047")->get();

                foreach ($keyword as  $keywords) {
                        print_r( '対象ID' .$keywords->recordingcardid." " );
                        print_r( 'ShopID' .$shop ->id." " );
                        $url = $site_url.$keywords->recordingcardid;

                        $goutte = GoutteFacade::request('GET', $url);
                        $goutte ->text();


                        if($shop ->id == 1){
                            $this->scraping_c_labo($goutte,$shop ->id,$keywords->recordingcardid);
                            $end = microtime(true);
                            print_r( '処理時間 = ' . ($end - $start) . '秒' );
                        }

                        if($shop ->id == 2){
                            $this->scraping_amenityDream($goutte,$shop ->id,$keywords->recordingcardid);
                            $end = microtime(true);
                            print_r( '処理時間 = ' . ($end - $start) . '秒');
                        }
                        if($shop ->id == 3){
                          break;

                        }
                        print_r("\n" );
                  }
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
        print_r("aiueo");
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

            $note = $div->filter('span.goods_name')->text();
            $note_start = mb_strpos($note, "《",1)+1;
            $note_end = mb_strpos($note, "》" , 1)-$note_start;
            $notes = null;

            if(1 <= $note_end){
                $notes = mb_substr($note, $note_start , $note_end);
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
}
