<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonsterCardClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monster_card_classes', function (Blueprint $table) {
            $table->integer('card_master_id');//カードマスタIDを保存するカラム
            $table->integer('class_id');//種類IDを保存するカラム

            $table->timestamps();

            //プライマリキー(複合キー)を設定する
            $table->primary(['card_master_id', 'class_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monster_card_classes');
    }
}
