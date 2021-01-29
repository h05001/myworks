<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordingPackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recording_packs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('recordingpack'); //収録パック名を保存するカラム
            $table->string('recordingpackid'); //収録パックIDを保存するカラム

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
        Schema::dropIfExists('recording_packs');
    }
}
