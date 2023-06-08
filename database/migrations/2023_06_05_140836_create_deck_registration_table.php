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
        Schema::create('deck_registration', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('deck_id'); //入賞デッキIDを保存するカラム
            $table->integer('kinds'); //種別を保存するカラム
            $table->string('card_name'); //カード名を保存するカラム
            $table->integer('card_master_id')->nullable(); //カードマスタIDを保存するカラム
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
        Schema::dropIfExists('deck_registration');
    }
}
