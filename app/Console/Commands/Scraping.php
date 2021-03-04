<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Weidner\Goutte\GoutteFacade as GoutteFacade;

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
      {
      echo "start1\n";
        //ここにコマンドの実行処理を書く
       $goutte = GoutteFacade::request('GET', 'https://www.c-labo-online.jp/product/148044');
       $goutte ->text();

       $goutte->filter('div.product_name_inside')->each(function ($div) {

                echo "-------------\n";

                echo 'カード名：' . $div->filter('span.goods_name')->text() . "\n";

                echo "-------------\n";

        });

        echo '価格：' . $goutte->filter('#pricech')->text() . "\n";
      }

      {
      echo "start2\n";
        //ここにコマンドの実行処理を書く
       $goutte = GoutteFacade::request('GET', 'https://www.amenitydream.com/product/112710');
       $goutte ->text();

       $goutte->filter('div.product_name_inside')->each(function ($div) {

                echo "-------------\n";

                echo 'カード名：' . $div->filter('span.goods_name')->text() . "\n";

                echo "-------------\n";

        });

        echo '価格：' . $goutte->filter('#pricech')->text() . "\n";
      }

      {
      echo "start3\n";
        //ここにコマンドの実行処理を書く
       $goutte = GoutteFacade::request('GET', 'https://yuyu-tei.jp/game_ygo/carddetail/cardpreview.php?VER=blvo&CID=10004&MODE=sell');
       $goutte ->text();

       $goutte->filter('div.product_name_inside')->each(function ($div) {

                echo "-------------\n";

                echo 'カード名：' . $div->filter('span.group_ruby')->text() . "\n";

                echo "-------------\n";

        });

        echo '価格：' . $goutte->filter('p.price')->text() . "\n";
      }


    }
}
