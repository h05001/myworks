<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cardshop'); //カードショップ名を保存するカラム
            $table->string('URL'); //ショップサイトのURLを保存するカラム

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
        Schema::dropIfExists('card_shops');
    }
}
