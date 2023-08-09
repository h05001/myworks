<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeckRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_deck_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tournament_deck_id'); //入賞デッキIDを保存するカラム
            $table->integer('kinds'); //種別を保存するカラム 1:メイン　2:エクストラ　3:サイド
            $table->integer('card_master_id')->nullable(); //カードマスタIDを保存するカラム
            $table->string('card_name'); //カード名を保存するカラム
            $table->integer('card_class'); //カード種類を保存するカラム 1:モンスター　2：魔法　3:罠
            $table->integer('number'); //投入枚数を保存するカラム
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
        Schema::dropIfExists('tournament_deck_cards');
    }
}
