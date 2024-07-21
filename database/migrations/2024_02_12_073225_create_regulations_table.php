<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regulations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('regulation_id'); //レギュレーションIDを保存するカラム
            $table->integer('card_master_id')->nullable(); //カードマスタIDを保存するカラム
            $table->string('card_name'); //カード名を保存するカラム
            $table->integer('able'); //投入可能枚数を保存するカラム
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
        Schema::dropIfExists('regulations');
    }
}
