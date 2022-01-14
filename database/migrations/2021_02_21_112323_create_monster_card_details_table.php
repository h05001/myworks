<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonsterCardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monster_card_details', function (Blueprint $table) {
            $table->increments('card_master_id');//カードマスタIDを保存するカラム
            $table->string('property'); //属性を保存するカラム
            $table->integer('tribe_id'); //種族IDを保存するカラム
            $table->integer('level_rank_link'); //レベルを保存するカラム
            $table->integer('scale')->nullable(); //スケールを保存するカラム
            $table->string('pendulum_effect')->nullable(); //ペンデュラム効果を保存するカラム
            $table->string('link_marker')->nullable(); //リンクマーカーの向きを保存するカラム
            $table->string('attack'); //攻撃力を保存するカラム
            $table->string('defense')->nullable(); //守備力を保存するカラム
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
        Schema::dropIfExists('monster_card_details');
    }
}
