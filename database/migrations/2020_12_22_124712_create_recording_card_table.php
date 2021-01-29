<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordingCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recording_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cardname'); //カード名を保存するカラム
            $table->string('recordingpackid'); //収録パックIDを保存するカラム
            $table->string('recordingcardid'); //収録カードIDを保存するカラム
            $table->string('rarity'); //レアリティを保存するカラム
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
        Schema::dropIfExists('recording_cards');
    }
}
