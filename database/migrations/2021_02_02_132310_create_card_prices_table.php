<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cardshop_id'); //カードショップIDを保存するカラム
            $table->string('recordingcard_id'); //収録カードマスタIDを保存するカラム
            $table->string('rarity_convert'); //レアリティ変換を保存するカラム
            $table->integer('cardprice');  // カード価格を保存するカラム
            $table->string('notes')->nullable(); //備考欄
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_prices');
    }
}
