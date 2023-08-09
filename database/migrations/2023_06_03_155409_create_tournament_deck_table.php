<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentDeckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_decks', function (Blueprint $table) {
          $table->increments('id');//IDを保存するカラム
          $table->integer('tournament_id'); //大会IDを保存するカラム
          $table->string('deck_name'); //デッキ名を保存するカラム
          $table->integer('rank'); //順位を保存するカラム
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
        Schema::dropIfExists('tournament_decks');
    }
}
