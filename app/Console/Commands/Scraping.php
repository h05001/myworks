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


                // データベースに保存する
                $check = RecordingCard::where('recordingcardid',$keywords->recordingcardid)
                       -> where('rarity_id',$rarities);



                $cardprice = new CardPrice;

                $cardprice->cardprice = $price;

                $cardprice->save();

            });
        }
    }
}
