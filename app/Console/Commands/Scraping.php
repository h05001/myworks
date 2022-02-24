<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Weidner\Goutte\GoutteFacade as GoutteFacade;
use App\RecordingCard;

class Scraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

     //スクレイピング
     protected $signature = 'command:scraping';
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


        $keyword = RecordingCard::select('recordingcardid')->get();

        $keyword = $keyword->unique('recordingcardid');

        foreach ($keyword as  $keywords) {

            $url = "https://www.c-labo-online.jp/product-list?keyword=".$keywords->recordingcardid;

            $goutte = GoutteFacade::request('GET', $url);
            $goutte ->text();

            $goutte ->filter('div.list_item_data')->each(function ($div) {


                $rarity = $div->filter('span.goods_name')->text();
                $rarity_start = mb_strpos($rarity, "【", 4)+1;
                $rarity_end = mb_strpos($rarity, "/" , 4)-$rarity_start;
                $rarities = mb_substr($rarity, $rarity_start , $rarity_end);

                $price = $div->filter('span.figure')->text();

                $note = $div->filter('span.goods_name')->text();
                $note_start = mb_strpos($note, "《",1)+1;
                $note_end = mb_strpos($note, "》" , 1)-$note_start;
                $notes = null;

                if(1 <= $note_end){
                    $notes = mb_substr($note, $note_start , $note_end);
                }



                // データベースに保存する
                $check = RecordingCard ::leftjoin('rarities', 'recording_cards.rarity_id', '=', 'rarities.id')
                                       ->leftjoin('rarity_converts', 'recording_cards.rarity_id', '=', 'rarity_converts.rarity_id');
                $check = RecordingCard ::where('recordingcardid',$keywords->recordingcardid)
                                       -> where('rarity_convert',$shop_id)
                                       -> where('rarity_convert',$rarities);

dd($check);

                $cardprice = new CardPrice;
                $cardprice->shop_id = $check->$shop_id;
                $cardprice->recordingcard_id = $cheak->recordingcardid;
                $cardprice->rarity_convert = $cheak->rarity_convert;
                $cardprice->cardprice = $price;
                $cardprice->cardprice = $notes;
                $cardprice->save();

            });
        }
    }
}

/*
                $goutte = GoutteFacade::request('GET','https://www.c-labo-online.jp/product-list?keyword=BLVO-JP002' );
                $goutte ->text();

                $goutte ->filter('div.list_item_data')->each(function ($div) {

                    $note = $div->filter('span.goods_name')->text();
                    $note_start = mb_strpos($note, "《",1)+1;

                    $note_end = mb_strpos($note, "》" , 1)-$note_start;
                    $notes = null;

                    if(1 <= $note_end){

                        $notes = mb_substr($note, $note_start , $note_end);
                    }



                    $card_name = $div->filter('span.goods_name')->text();
                    $card_name_start = mb_strpos($card_name, "】",1)+1;
                    $card_name_end = mb_strpos($card_name, "【" , 10)-$card_name_start;
                    //$card_name_end = mb_strpos($card_name, "【" , 4)-$card_name_start;
                    $card_names = mb_substr($card_name, $card_name_start , $card_name_end);


                    $rarity = $div->filter('span.goods_name')->text();
                    $rarity_start = mb_strpos($rarity, "【", 10)+1;
                    //$rarity_start = mb_strpos($rarity, "【", 4)+1;
                    $rarity_end = mb_strpos($rarity, "/" , 4)-$rarity_start;
                    $rarities = mb_substr($rarity, $rarity_start , $rarity_end);


                    $price = $div->filter('span.figure')->text();

                    echo "-----------------------------------------\n";
                    echo $card_names;
                    echo "\n";
                    echo $rarities;
                    echo "\n";
                    echo $price;
                    echo "\n";
                    //if(1 < $note_start && 1 < $note_end){
                        echo $notes;
                        echo "\n";
                    //}
                    echo "-----------------------------------------\n";

*/
